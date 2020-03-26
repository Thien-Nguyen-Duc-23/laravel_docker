<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Services\BookService;
use Exception;

class SearchController extends Controller
{
    protected $book;

    public function __construct(BookService $book)
    {
        $this->book = $book;
    }

    // function show index search
    public function index(Request $request)
    {
        try {
            $value = $request->value;
            $count = $this->book->search($request->value)->count();
            $getAllBooks = $this->book->paginate($request->value);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return view('client.search.index', compact('getAllBooks', 'value', 'count'));
    }

    // function suggestions
    public function find(Request $request)
    {
        try {
            $books = $this->book->search($request->value);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return response()->json($books);
    }
}
