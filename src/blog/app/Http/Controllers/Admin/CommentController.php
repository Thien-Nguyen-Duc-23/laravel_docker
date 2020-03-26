<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CommentService;

class CommentController extends Controller
{
    protected $comment;

    public function __construct(CommentService $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $comments = $this->comment->getReviews();
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        
        return view('admin.comments.index', compact('comments'));
    }
}
