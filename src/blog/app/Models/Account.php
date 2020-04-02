<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Foundation\Auth\User as AuthUser;

use Tymon\JWTAuth\Contracts\JWTSubject;

class Account extends Authenticatable implements JWTSubject
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

    // JWT の sub に含める値。主キーを使う
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // JWT のクレームに追加する値。今回は特になし
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected static function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public static function me()
    {
        return response()->json(auth()->user());
    }
}
