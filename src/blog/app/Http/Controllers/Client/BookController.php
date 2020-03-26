<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BookmartService;
use App\Repositories\Comments\CommentRepositoryInterface as Comment;
use Event;
use App\Services\BookService;

class BookController extends Controller
{
    protected $book;
    protected $bookmart;
    protected $comment;

    public function __construct(BookService $book, BookmartService $bookmart, Comment $comment)
    {
        $this->book = $book;
        $this->bookmart = $bookmart;
        $this->comment = $comment;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $orderBy = $request->orderby;
            $books = $this->book->sort($request);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return view('client.books.index', compact('books', 'orderBy'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        try {
            $book = $this->book->findSlug($slug);
            $bookmart = $this->bookmart->getBookmartOfUser($book->id);
            Event::fire('book.view', $book);
            $comments = $this->comment->getCommentPaginate($book->id);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        
        return view('client.books.detail', compact('book', 'bookmart', 'comments'));
    }
}
