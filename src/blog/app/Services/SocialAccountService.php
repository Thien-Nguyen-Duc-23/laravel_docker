<?php
namespace App\Services;

use App\Repositories\SocialAccount\SocialAccountInterfaceRepository as SocicalRepo;
use App\Repositories\Accounts\AccountInterfaceRepository as AccountRepo;
use App\Repositories\InformationAccount\InformationAccountInterfaceRepository as InformationRepo;
use Illuminate\Http\Request;
use App\Models\SocialAccount;
use App\Models\UserInformation;
use App\Models\Account;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Hash;

class SocialAccountService
{
    protected $social;
    protected $accountUser;
    protected $information;
    
    // inject SocialAccountInterfaceRepository in construct
    public function __construct(SocicalRepo $social, AccountRepo $account, InformationRepo $infor)
    {
        $this->social = $social;
        $this->accountUser = $account;
        $this->information = $infor;
    }

    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->account;
        } else {
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook',
            ]);

            $user = Account::whereEmail($providerUser->getEmail())->first();

            if (!$user) {
                $attributesAccountUser = [
                    'email' => $providerUser->getEmail(),
                    'password' => Hash::make($providerUser->getName()),
                    'role_id' => config('define.user'),
                    'status' => config('define.active'),
                ];
        
                $user = $this->accountUser->create($attributesAccountUser);

                $attributes = [
                    'full_name' => $providerUser->getName(),
                    'avatar' => 'default.png',
                    'account_id' => $user->id,
                ];
        
                $resultInformation = $this->information->create($attributes);
            }

            $account->account()->associate($user);
            $account->save();

            return $user;
        }
    }
}
