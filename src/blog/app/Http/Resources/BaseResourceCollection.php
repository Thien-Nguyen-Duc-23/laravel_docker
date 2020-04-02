<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseResourceCollection extends ResourceCollection
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
