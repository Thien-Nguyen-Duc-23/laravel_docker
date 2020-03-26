<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Book\BookRepositoryInterface;

class CategoryComposer
{
    protected $category;
    protected $book;

    /**
      * Create a category composer.
      *
      * @return void
      */
    public function __construct(CategoryRepositoryInterface $category, BookRepositoryInterface $book)
    {
        $this->category = $category;
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
        $items = $this->category->getTreeCategory();
        $bookView = $this->book->getBookByView(3);
        $books = $this->book->getBookActive();

        $view->with(['items' => $items, 'bookView' => $bookView, 'books' => $books]);
    }
}
