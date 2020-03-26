<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;
use Session;

class Filter
{
    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $book = $this->getViewedBooks();

        if (!is_null($book)) {
            $book = $this->cleanExpiredViews($book);
            $this->storeBook($book);
        }

        return $next($request);
    }

    private function getViewedBooks()
    {
        return $this->session->get('viewed_books', null);
    }

    private function cleanExpiredViews($book)
    {
        $time = time();

        // Let the views expire after one hour.
        $throttleTime = 60;

        return array_filter($book, function ($timestamp) use ($time, $throttleTime) {
            return ($timestamp + $throttleTime) > $time;
        });
    }

    private function storeBook($book)
    {
        $this->session->put('viewed_books', $book);
    }
}
