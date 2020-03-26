<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\RateService;
use App\Services\CommentService;
use App\Http\Requests\Client\RateRequest;
use App\Http\Requests\Client\CommentRequest;

class RatingCommentController extends Controller
{
    protected $rate;
    protected $comment;

    public function __construct(RateService $rate, CommentService $comment)
    {
        $this->rate = $rate;
        $this->comment = $comment;
    }

    public function rateIndex()
    {
        abort(404);
    }

    public function commentIndex()
    {
        abort(404);
    }

    public function rate(RateRequest $request)
    {
        try {
            $this->rate->rating($request);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        
        return redirect()->back();
    }
    
    public function comment(CommentRequest $request)
    {
        try {
            $this->comment->comment($request);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        
        return redirect()->back();
    }
}
