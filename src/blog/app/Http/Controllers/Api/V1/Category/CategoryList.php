<?php

namespace App\Http\Controllers\Api\V1\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\BookService;
use App\Http\Resources\Category\CategoryResourceCollection;
use App\Http\Resources\Book\BookResourceCollection;

class CategoryList extends Controller
{
    protected $category;
    protected $book;

    public function __construct(CategoryService $category, BookService $book)
    {
        $this->category = $category;
        $this->book = $book;
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

    public function bookOfCategory(Request $request)
    {
        try {
            $getCategory = $this->category->getFistSlugCategory($request->slug);
            if ($getCategory) {
                $books = $this->book->getBookFolowCate($getCategory->id, $getCategory->slug);
            } else {
                return $this->apiResponse(200000, ['messages' => 'No books return !!!'], null, 200);
            }
        } catch (Exception $exception) {
            return $this->apiResponse(400000, ['messages' => 'There was an error retrieving the book !!!'], null, 400);
        }

        return new BookResourceCollection($books);
    }
}
