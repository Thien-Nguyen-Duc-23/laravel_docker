<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class UserActivation extends Model
{
    protected $table = 'user_activations';

    protected function getToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    public function createActivation($account)
    {
        $activation = $this->getActivation($account);

        if (!$activation) {
            return $this->createToken($account);
        }

        return $this->regenerateToken($account);
    }

    private function regenerateToken($account)
    {
        $token = $this->getToken();
        UserActivation::where('account_id', $account->id)->update([
            'token' => $token,
            'created_at' => new Carbon(),
        ]);

        return $token;
    }

    private function createToken($account)
    {
        $token = $this->getToken();
        UserActivation::insert([
            'account_id' => $account->id,
            'token' => $token,
            'created_at' => new Carbon(),
        ]);

        return $token;
    }

    public function getActivation($account)
    {
        return UserActivation::where('account_id', $account->id)->first();
    }

    public function getActivationByToken($token)
    {
        return UserActivation::where('token', $token)->first();
    }

    public function deleteActivation($token)
    {
        UserActivation::where('token', $token)->delete();
    }
}
