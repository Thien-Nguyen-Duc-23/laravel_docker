<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Rate;
use App\Models\Comment;
use App\Models\Bookmart;

class Book extends Model
{
    use SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['comment', 'rate', 'bookmart'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'conver',
        'isbn',
        'author',
        'discription',
        'content',
        'status',
        'slug',
        'publisher_id',
        'category_id',
        'view_count',
    ];

    protected $appends = ['short_desc', 'format_date', 'diff_now', 'short_title', 'star'];

    //  create relationships with table category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // create relationships with table user infrormation
    public function userInformation()
    {
        return $this->belongsTo(UserInformation::class, 'publisher_id', 'id');
    }

    /**
     * Get the book's short description.
     *
     * @return string
     */
    public function getShortDescAttribute()
    {
        return Str::words($this->attributes['discription'], config('define.lengthDescription'), '(...)');
    }


    /**
     * Get the book's format date
     *
     * @return string
     */
    public function getFormatDateAttribute()
    {
        $formatDate = Carbon::parse($this->attributes['created_at']);

        return $formatDate->toFormattedDateString();
    }

    /**
     * Get the book's format create_at
     *
     * @return string
     */
    public function getDiffNowAttribute()
    {
        $createdAt = Carbon::parse($this->attributes['created_at']);
        $now = Carbon::now();

        return $createdAt->diffForHumans($now);
    }

    public function bookmart()
    {
        return $this->hasMany(Bookmart::class, 'book_id', 'id');
    }

    /**
     * Get the book's star
     *
     * @return float
     */
    public function getStarAttribute()
    {
        $star = $this->rate->avg('star');

        return number_format($star, 2);
    }

    /* Get the book's short title.
     *
     * @return string
     */
    public function getShortTitleAttribute()
    {
        return Str::words($this->attributes['title'], config('define.lengthTitle'), ' ...');
    }

    //relationship with rates table
    public function rate()
    {
        return $this->hasMany(Rate::class, 'book_id', 'id');
    }

    //relationship with comments table
    public function comment()
    {
        return $this->hasMany(Comment::class, 'book_id', 'id');
    }


    // // get book of category follow slug
    // public function getBookOfCategory($slug)
    // {
    //     return $this->belongsTo(Category::class, 'category_id', 'id')
    //         ->with('book')
    //         ->where('slug', $slug)
    //         ->orWhere('id', function($query) use ($slug) {
    //             $query->select('*')
    //             ->from('categories')
    //             ->join('categories as chilren', 'categories.id', '=', 'chilren.parent_id')
    //             ->where()
    //         });
    // }
}
