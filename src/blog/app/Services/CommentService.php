<?php

namespace App\Services;

use App\Repositories\Comments\CommentRepositoryInterface;
use App\Http\Requests\Client\CommentRequest;
use Illuminate\Http\Request;

class CommentService
{
    protected $comment;

    public function __construct(CommentRepositoryInterface $comment)
    {
        $this->comment = $comment;
    }

    public function comment(CommentRequest $request)
    {
        $attributes = [
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'content' => $request->comment,
            'status' => config('define.disable'),
        ];

        return $this->comment->create($attributes);
    }

    // get all comment
    public function getReviews()
    {
        return $this->comment->getReviews();
    }

    // function accept review
    public function acceptReview(Request $request)
    {
        $id = $request->id;
        $checkStatus = $this->comment->find($id);

        if ($checkStatus->status == config('define.active')) {
            $attributes = [
                'status' => config('define.disable'),
            ];
        } else {
            $attributes = [
                'status' => config('define.active'),
            ];
        }
        
        $result = $this->comment->update($id, $attributes);

        return $result;
    }
}
