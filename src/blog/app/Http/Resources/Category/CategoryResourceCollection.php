<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\BaseResourceCollection;
use Illuminate\Http\Request;

/**
 * Class ArticleResourceCollection
 * @package App\Http\Resources
 */
class CategoryResourceCollection extends BaseResourceCollection
{

    public $collects = 'App\Http\Resources\Category\CategoriesResource';

    public function __construct($resource)
    {
        if (method_exists($resource, 'currentPage')) {
            $this->meta = [
                'count' => $resource->total(),
                'page_no' => $resource->currentPage(),
                'page_size' => (int)$resource->perPage(),
                'total_page' => $resource->lastPage(),
            ];
            $resource = $resource->getCollection();
        } else {
            $this->meta = [
                'count' => $resource->count(),
                'page_no' => null,
                'page_size' => null,
                'total_page' => null,
            ];
            $this->resource = $this->collectResource($resource);
        }

        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'books' => $this->collection
            ],
        ];
    }

    public function with($request)
    {
        return [
            'code' => 200000,
            'meta' => $this->meta,
        ];
    }
}
