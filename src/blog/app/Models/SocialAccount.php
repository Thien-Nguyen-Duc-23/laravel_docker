<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    // declare fillable
    protected $fillable = [
        'provider_user_id',
        'provider',
        'user_id',
    ];
    
    // create relationships with table userInformation
    public function account()
    {
        return $this->belongsTo(Account::class, 'user_id', 'id');
    }
}
