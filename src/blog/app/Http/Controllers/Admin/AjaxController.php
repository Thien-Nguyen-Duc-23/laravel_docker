<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AccountService as Acc;
use Exception;
use App\Services\ContactService as Con;
use App\Services\CommentService as Comment;
use App\Services\DashboardService as Dash;
use App\Services\BookService as Book;

class AjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // declare variable accountInterfaceRepository
    protected $account;
    protected $contact;
    protected $comment;
    protected $dashboard;
    protected $book;

    // inject AccountService in construct
    public function __construct(Acc $account, Con $contact, Comment $comment, Dash $dashboard, Book $book)
    {
        $this->account = $account;
        $this->contact = $contact;
        $this->comment = $comment;
        $this->dashboard = $dashboard;
        $this->book = $book;
    }

    public function updateStatusUser(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        try {
            $result = $this->account->updateStatusUser($request);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        if ($result) {
            return view('admin.users.ban', compact('status', 'id'));
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Change status Fail!!']);
        }
    }

    // function acceptContact
    public function acceptContact(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        try {
            $result = $this->contact->acceptContact($request);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        if ($result) {
            return view('admin.contacts.accept', compact('status', 'id'));
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Change status Fail!!']);
        }
    }

    // function accept review
    public function acceptComment(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        try {
            $result = $this->comment->acceptReview($request);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        if ($result) {
            return view('admin.comments.acceptOrHide', compact('status', 'id'));
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Change status Fail!!']);
        }
    }

    public function getUserFollowOfBook($bookId)
    {
        $userFollow = $this->dashboard->getUserFollowOfBook($bookId);

        return ['data' => $userFollow];
    }

    // function accept book
    public function acceptBook(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        try {
            $result = $this->book->acceptBook($request);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        if ($result) {
            return view('admin.books.accept', compact('status', 'id'));
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Change status Fail!!']);
        }
    }
}
