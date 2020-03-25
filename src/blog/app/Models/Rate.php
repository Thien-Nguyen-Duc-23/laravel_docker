<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rate extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'star',
        'user_id',
        'book_id',
    ];

    public function userInfo()
    {
        return $this->belongsTo(UserInformation::class, 'user_id', 'id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
