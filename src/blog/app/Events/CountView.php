<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Book;
use Illuminate\Session\Store;

class CountView
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $session;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    // public function broadcastOn()
    // {
    //     return new PrivateChannel('channel-name');
    // }

    public function handle(Book $book)
    {
        if (!$this->isBookViewed($book)) {
            $book->increment('view_count');
            $this->storeBook($book);
        }
    }

    private function isBookViewed($book)
    {
        $viewed = $this->session->get('viewed_books', []);

        return array_key_exists($book->id, $viewed);
    }

    private function storeBook($book)
    {
        $key = 'viewed_books.' . $book->id;

        $this->session->put($key, time());
    }
}
