<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Foundation\Auth\User as AuthUser;

class Account extends Authenticatable
{
    // use EntrustUserTrait;
    use Notifiable;
    protected $guarded= [];
    // declare fillable
    protected $fillable = [
        'email',
        'password',
        'status',
        'role_id',
    ];

    use SoftDeletes;
    protected $guard = [];

    // create relationships with table role
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    // create relationships with table UserInformation
    public function userInformation()
    {
        return $this->hasOne(UserInformation::class, 'account_id', 'id');
    }

    // create relationships with table social account
    public function socialAccount()
    {
        return $this->hasMany(SocialAccount::class, 'user_id', 'id');
    }
}
