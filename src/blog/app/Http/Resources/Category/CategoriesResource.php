<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\BaseJsonResource;
use App\Http\Resources\Rate\RateResource;

class CategoriesResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $count = $this->book->count();
        if (!$this->children->isEmpty()) {
            foreach($this->children as $children) {
                $count += $children->book->count();
            }
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'cover' => \Storage::disk('public')->exists('/admin/categories/'.$this->cover) ? asset('admin/categories/'.$this->cover) : asset('admin/images/no-image.png'),
            'parent_id' => $this->parent_id,
            'slug' => $this->slug,
            'books' => $count,
            'children_category' => !$this->children->isEmpty() ? CategoryResource::collection($this->children) : [],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
