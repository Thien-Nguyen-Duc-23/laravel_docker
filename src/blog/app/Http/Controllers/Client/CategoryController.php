<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(CategoryService $category)
    {
        $this->category = $category;
    }

    public function index($slug)
    {
        try {
            $getCategory = $this->category->getFistSlugCategory($slug);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        
        return view('client.categories.index')->with('getCategory', $getCategory);
    }

    public function childCategory($slug, $childSlug)
    {
        try {
            $getCategory = $this->category->getFistSlugCategory($childSlug);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        
        return view('client.categories.child')->with('getCategory', $getCategory);
    }
}
