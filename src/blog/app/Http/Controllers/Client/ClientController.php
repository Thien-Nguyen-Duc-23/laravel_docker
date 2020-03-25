<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;

class ClientController extends Controller
{
    protected $book;
    protected $category;

    public function __construct(BookRepositoryInterface $book, CategoryRepositoryInterface $category)
    {
        $this->book = $book;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $getABook = $this->book->getRandomBook(1);
            $getThreeBook = $this->book->getRandomBook(3);
            $latestBook = $this->book->getLatestBook();
            $categories = $this->category->getFourCategories();
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        
        return view('client.homepage.index', compact('getABook', 'categories', 'latestBook', 'getThreeBook'));
    }
}
