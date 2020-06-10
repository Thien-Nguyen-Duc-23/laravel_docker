<?php

namespace App\Http\Controllers\Api\V1\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\CategoryService;
use App\Http\Resources\Category\CategoryResourceCollection;
use App\Http\Resources\Category\CategoryResource;

class CategoryList extends Controller
{
    protected $category;

    public function __construct(CategoryService $category)
    {
        $this->category = $category;
    }

    public function index(Request $request)
    {
        try {
            $categories = $this->category->getAllCategories();
            $treeCategory = $this->category->getTreeCategory();
        } catch (Exception $exception) {
            return $this->apiResponse(400000, ['messages' => 'There was an error retrieving the book !!!'], null, 400);
        }

        return new CategoryResourceCollection($categories);
    }
}
