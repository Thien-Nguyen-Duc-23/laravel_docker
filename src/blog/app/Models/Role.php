<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // declare fillable
    protected $fillable = [
        'name',
    ];
    
    // create relationships with table account
    public function account()
    {
        return $this->hasMany(Account::class, 'role_id', 'id');
    }
}
