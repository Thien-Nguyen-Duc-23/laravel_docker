<?php

namespace App\Services;

use Mail;
use App\Models\UserActivation;
use App\Mail\UserActivationEmail;
use App\Models\Account;
use Illuminate\Support\Carbon;

class ActivationService
{
    protected $resendAfter = 24; // Sẽ gửi lại mã xác thực sau 24h nếu thực hiện sendActivationMail()
    protected $userActivation;

    public function __construct(UserActivation $userActivation)
    {
        $this->userActivation = $userActivation;
    }

    public function sendActivationMail($account)
    {
        if ($account->activated || !$this->shouldSend($account)) {
            return;
        }

        $token = $this->userActivation->createActivation($account);
        $account->activation_link = route('account.activate', $token);
        $mailable = new UserActivationEmail($account);
        Mail::to($account->email)->send($mailable);
    }

    public function activateUser($token)
    {
        $activation = $this->userActivation->getActivationByToken($token);
        if ($activation === null) {
            return null;
        }
        
        $account = Account::find($activation->account_id);
        $account->active = true;
        $account->save();
        $this->userActivation->deleteActivation($token);

        return $account;
    }

    private function shouldSend($account)
    {
        $activation = $this->userActivation->getActivation($account);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }
}
