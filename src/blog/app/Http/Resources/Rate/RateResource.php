<?php

namespace App\Http\Resources\Rate;

use App\Http\Resources\BaseJsonResource;

class RateResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "star" => $this->star,
            "user_id" => $this->user_id,
            "book_id" => $this->book_id,
        ];
    }
}
