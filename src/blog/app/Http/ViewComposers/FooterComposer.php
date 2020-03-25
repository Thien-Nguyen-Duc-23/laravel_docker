<?php

namespace app\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Book\BookRepositoryInterface;

class FooterComposer
{
    protected $book;

    //inject BookRepositoryInterface in contruct
    public function __construct(BookRepositoryInterface $book)
    {
        $this->book = $book;
    }

    /**
      * Bind data to the view.
      *
      * @param  View  $view
      * @return void
      */
    public function compose(View $view)
    {
        $items = $this->book->getLatestBook();

        $view->with('items', $items);
    }
}
