<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Account;
use App\Models\Comment;

class NewComment extends Notification implements ShouldQueue
{
    use Queueable;

    protected $account;
    protected $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Account $account, Comment $comment)
    {
        $this->comment = $comment;
        $this->account = $account;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user_id' => $this->account->userInformation->id,
            'user_name' => $this->account->userInformation->full_name,
            'avatar' => $this->account->userInformation->avatar,
            'comment' => $this->comment->content,
            'book_name' => $this->comment->book->title,
            'link' => route('comments.index'),
        ];
    }
}
