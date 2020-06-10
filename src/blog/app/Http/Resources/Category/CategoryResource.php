<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\BaseJsonResource;
use App\Http\Resources\Rate\RateResource;

class CategoryResource extends BaseJsonResource
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
            'name' => $this->name,
            'cover' => \Storage::disk('public')->exists('/admin/categories/'.$this->cover) ? \Storage::url('admin/categories/'.$this->cover) : asset('admin/images/no-image.png'),
            'parent_id' => $this->parent_id,
            'slug' => $this->slug,
            'books' => $this->book->count(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
