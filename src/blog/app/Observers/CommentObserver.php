<?php

namespace App\Observers;

use App\Models\Comment;
use App\Notifications\NewComment;
use App\Models\Account;
use App\Events\CommentCreated;
use Illuminate\Support\Facades\Notification;

class CommentObserver
{
    /**
     * Handle the comment "created" event.
     *
     * @param  \App\Comment  $comment
     * @return void
     */
    public function created(Comment $comment)
    {
        $data = [
            'user_name' => $comment->userInfo->full_name,
            'comment' => $comment->content,
            'created_at' => diffNow($comment->created_at),
        ];
        
        event(new CommentCreated($data));
        $account = $comment->userInfo->account;
        $users = Account::where('role_id', '<>', config('define.user'))->get();
        Notification::send($users, new NewComment($account, $comment));
    }
}
