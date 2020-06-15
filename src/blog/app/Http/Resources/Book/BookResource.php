<?php

namespace App\Http\Resources\Book;

use App\Http\Resources\BaseJsonResource;
use App\Http\Resources\Rate\RateResource;

class BookResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'conver' => \Storage::disk('public')->exists('/admin/books/'.$this->conver) ? asset('admin/books/'.$this->conver) : asset('admin/images/no-image.png'),
            'isbn' => $this->isbn,
            'author' => $this->author,
            'discription' => $this->discription,
            'content' => $this->content,
            'status' => $this->status,
            'slug' => $this->slug,
            'publisher_id' => $this->publisher_id,
            'category_id' => $this->category_id,
            'view_count' => $this->view_count,
            'short_desc' => $this->short_desc,
            'format_date' => $this->format_date,
            'diff_now' => $this->diff_now,
            'short_title' => $this->short_title,
            'star' => $this->star,
            'rates' => RateResource::collection($this->rate),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
