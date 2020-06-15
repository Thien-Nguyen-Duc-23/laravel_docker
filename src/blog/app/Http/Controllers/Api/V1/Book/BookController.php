<?php

namespace App\Http\Controllers\Api\V1\Book;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Comments\CommentRepositoryInterface as Comment;
use App\Http\Resources\Book\BookResourceCollection;
use App\Http\Resources\Book\BookResource;
use App\Services\BookmartService;
use App\Services\BookService;
use Event;

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
            return $this->apiResponse(400000, ['messages' => 'There was an error retrieving the book !!!'], null, 400);
        }

        return new BookResourceCollection($books);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        try {
            $book = $this->book->findSlug($request->slug);
            $bookmart = $this->bookmart->getBookmartOfUser($book->id);
            Event::fire('book.view', $book);
            $comments = $this->comment->getCommentPaginate($book->id);
        } catch (Exception $exception) {
            return $this->apiResponse(400000, ['messages' => 'There was an error retrieving the book !!!'], null, 400);
        }

        return $this->apiResponse(200000, [
            'book' => new BookResource($book),
            'bookmart' => $bookmart,
            'comments' => $comments
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topBook(Request $request)
    {
        try {
            $latestBook = $this->book->getLatestBook();
            if (!$latestBook) {
                return $this->apiResponse(400000, ['messages' => 'There was an error retrieving the book !!!'], null, 400);
            }
        } catch (Exception $exception) {
            return $this->apiResponse(400000, ['messages' => 'There was an error retrieving the book !!!'], null, 400);
        }

        return BookResource::collection($latestBook);
    }
}
