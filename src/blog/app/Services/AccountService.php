<?php
namespace App\Services;

use App\Repositories\Accounts\AccountInterfaceRepository as AccountInt;
use App\Repositories\InformationAccount\InformationAccountInterfaceRepository as InfoAccInRe;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AccountRequest;
use App\Http\Requests\Client\RegisterRequest;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\Account;
use App\Models\UserInformation;
use App\Http\Requests\Admin\UpdateAccountRequest;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Helpers\AdminHelper;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Client\EditProfileRequest;
use App\Http\Requests\Client\ChangePasswordRequest;
use App\Http\Requests\Admin\ChangePassword;

class AccountService
{
    protected $account;
    protected $information;
    protected $activationService;

    // inject AccountInterfaceRepository and InformationAccountInterfaceRepository in construct
    public function __construct(AccountInt $accounts, InfoAccInRe $infor, ActivationService $activationService)
    {
        $this->account = $accounts;
        $this->information = $infor;
        $this->activationService = $activationService;
    }

    // create function create account
    public function storeAccount(AccountRequest $request)
    {
        $attributesAccount = [
            'email' => $request->email,
            'password' => Hash::make(config('define.password')),
            'role_id' => config('define.admin'),
            'status' => config('define.active'),
        ];

        $resultAccount = $this->account->create($attributesAccount);

        $attributes = [
            'full_name' => $request->fullName,
            'gender' => $request->gender,
            'date_of_birth' => $request->birthday,
            'avatar' => 'default.png',
            'address' => $request->address,
            'phone' => $request->phone,
            'account_id' => $resultAccount->id,
        ];

        $resultInformation = $this->information->create($attributes);

        return $resultAccount;
    }

    // get all accounts
    public function getAllInformation()
    {
        $result = Account::select('user_informations.id as infor', 'user_informations.*', 'accounts.*')
                ->join('user_informations', 'accounts.id', '=', 'user_informations.account_id')
                ->get();

        return $result;
    }

    // function ban account
    public function updateStatusUser(Request $request)
    {
        $id = $request->id;
        $checkStatus = $this->account->find($id);

        if ($checkStatus->status == config('define.active')) {
            $attributes = [
                'status' => config('define.disable'),
            ];
        } else {
            $attributes = [
                'status' => config('define.active'),
            ];
        }

        $result = $this->account->update($id, $attributes);

        return $result;
    }
    public function deleteAccount($id)
    {
        $folder = 'public/admin/accounts/';
        $oldFile = $this->account->find($id)->userInformation->avatar;

        AdminHelper::deleteFile($folder, $oldFile);

        return $this->account->find($id)->delete();
    }

    // get information of account
    public function editAccount($id)
    {
        $result = $this->account->find($id);

        return $result;
    }

    // functio update account
    public function updateAccount(UpdateAccountRequest $request, $id)
    {
        $attributesAccount = [
            'email' => $request->email,
        ];

        $resultAccount = $this->account->update($id, $attributesAccount);

        $folder = '/public/admin/accounts/';
        $colum = 'avatar';

        $attributes = [
            'full_name' => $request->fullName,
            'gender' => $request->gender,
            'date_of_birth' => $request->birthday,
            'address' => $request->address,
            'phone' => $request->phone,
        ];

        if ($request->file('avatarImage') == null) {
            $result = $this->information->update($id, $attributes);
        } else {
            $fileUpload = $request->file('avatarImage');
            $oldFile = $request->oldFile;

            $result = $this->information->updateUpload($id, $attributes, $fileUpload, $folder, $colum, $oldFile, null);
        }

        return $result;
    }

    //check Login Admin
    public function loginAdmin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            if (Auth::guard('admin')->user()->role_id != config('define.user') &&
                Auth::guard('admin')->user()->status == config('define.active')) {
                return redirect()->intended();
            } else {
                Auth::guard('admin')->logout();
                return redirect()->back()->with(['flag' => 'danger', 'message' => 'You do not have this access!!!']);
            }
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Email or password is invalid!!!']);
        }
    }

    //logout admin
    public function logoutAdmin()
    {
        Auth::guard('admin')->logout();
    }

    //Register User Account and send mail activition
    public function registerUser(RegisterRequest $request)
    {
        $attributesAccount = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => config('define.user'),
            'status' => config('define.active'),
        ];

        $resultAccount = $this->account->create($attributesAccount);

        event(new Registered($resultAccount));
        $this->activationService->sendActivationMail($resultAccount);

        $attributes = [
            'full_name' => $request->fullName,
            'avatar' => 'default.png',
            'account_id' => $resultAccount->id,
        ];

        $this->information->create($attributes);

        return $resultAccount;
    }

    //check Login Client
    public function loginClient(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('client')->attempt($credentials)) {
            if (Auth::guard('client')->user()->role_id == config('define.user') &&
                Auth::guard('client')->user()->status == config('define.active') &&
                Auth::guard('client')->user()->active == true) {
                return redirect()->intended();
            } else {
                Auth::guard('client')->logout();
                return redirect()->back()->with(['flag' => 'danger', 'message' => 'You do not have this access!!!']);
            }
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Email or password is invalid!!!']);
        }
    }

    //logout admin
    public function logoutClinet()
    {
        Auth::guard('client')->logout();
    }

    // function get user after login
    public function accountLess($role)
    {
        if ($role == config('define.superAdmin')) {
            $result = Account::where('role_id', '<>', $role)->get();
        } else {
            $result = Account::where('role_id', config('define.user'))->get();
        }

        return $result;
    }

    public function autoLogin($token)
    {
        if ($account = $this->activationService->activateUser($token)) {
            Auth::guard('client')->login($account);
        }
    }

    public function editProfile(EditProfileRequest $request, $id)
    {
        $attributes = [
            'full_name' => $request->full_name,
            'gender' => $request->user_gender,
            'date_of_birth' => $request->user_dob,
            'address' => $request->user_address,
            'phone' => $request->user_phone,
        ];

        $folder = '/public/admin/accounts/';
        $colum = 'avatar';

        if ($request->file('avatar') == null) {
            $result = $this->information->update($id, $attributes);
        } else {
            $fileUpload = $request->file('avatar');
            $oldFile = $request->oldFile;

            $result = $this->information->updateUpload($id, $attributes, $fileUpload, $folder, $colum, $oldFile, null);
        }

        return $result;
    }

    public function changePassword(ChangePasswordRequest $request, $id)
    {
        return $this->account->update($id, ['password' => Hash::make($request->password)]);
    }

    // function change password admin
    public function changePasswordAdmin($id, ChangePassword $request)
    {
        return $this->account->update($id, ['password' => Hash::make($request->password)]);
    }
}
