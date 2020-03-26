<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookmart extends Model
{
    use SoftDeletes;
    protected $table = 'bookmarts';

    // declare fillable
    protected $fillable = [
        'book_id',
        'user_id',
    ];

    // create relationships with table UserInformation
    public function userInformation()
    {
        return $this->belongsTo(UserInformation::class, 'user_id', 'id');
    }
    
    // create relationships with table book
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
