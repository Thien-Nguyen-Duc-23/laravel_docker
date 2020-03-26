<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use App\Models\Book;

class Category extends Model
{
    use SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['book', 'children'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'cover',
        'parent_id',
        'slug',
    ];

    public function parent()
    {
        return $this->hasOne('App\Models\Category', 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }

    //  create relationships with table book
    public function book()
    {
        return $this->hasMany(Book::class, 'category_id', 'id');
    }
}
