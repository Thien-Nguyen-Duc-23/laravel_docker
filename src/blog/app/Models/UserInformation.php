<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    protected $table = 'user_informations';

    // declare fillable
    protected $fillable = [
        'full_name',
        'gender',
        'date_of_birth',
        'avatar',
        'phone',
        'address',
        'account_id',
    ];

    // create relationships with table account
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
    
    // create relationships with table book
    public function book()
    {
        return $this->belongsTo(Book::class, 'publisher_id', 'id');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'user_id', 'id');
    }
    
    // create relationships with table bookmart
    public function bookmart()
    {
        return $this->hasMany(Bookmart::class, 'user_id', 'id');
    }

    public function rate()
    {
        return $this->hasMany(Rate::class, 'user_id', 'id');
    }
}
