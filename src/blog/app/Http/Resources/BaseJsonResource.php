<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BaseJsonResource extends JsonResource
{
    /**
     * @inheritDoc
     */
    public function with($request)
    {
        return [
            'code' => 200000,
            'meta' => null,
        ];
    }
}
