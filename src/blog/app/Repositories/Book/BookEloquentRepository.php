<?php
namespace App\Repositories\Book;

use App\Repositories\EloquentRepository;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class BookEloquentRepository extends EloquentRepository implements BookRepositoryInterface
{
    public function getModel()
    {
        return Book::class;
    }

    public function getRandomBook($quantity)
    {
        return $this->model::where('status', config('define.active'))->inRandomOrder()->take($quantity)->get();
    }

    public function getLatestBook()
    {
        return $this->model::where('status', config('define.active'))->orderBy('created_at', 'desc')->take(3)->get();
    }

    public function getBookPaginate()
    {
        return $this->model::where('status', config('define.active'))
            ->orderBy('created_at', 'desc')->paginate(config('define.paginate'));
    }

    public function getBookByView($quantity)
    {
        return $this->model::where('status', config('define.active'))
            ->orderBy('view_count', 'desc')->take($quantity)->get();
    }

    public function getBookActive()
    {
        return $this->model::where('status', config('define.active'))->get();
    }

    // function sort by comment
    public function getSortByComment()
    {
        return $this->model::selectRaw('books.id, count(book_id) as total, books.*')
            ->leftJoin('comments', 'books.id', '=', 'comments.book_id')
            ->groupBy('books.id')
            ->orderBy('total', 'DESC')
            ->where('books.status', config('define.active'))
            ->paginate(config('define.paginate'));
    }

    // function sort by rate
    public function getSortByRate()
    {
        return $this->model::select('books.*', DB::raw('AVG(rates.star) as average_rating'))
            ->leftJoin('rates', 'books.id', '=', 'rates.book_id')
            ->groupBy('books.id')
            ->orderBy('average_rating', 'DESC')
            ->where('books.status', config('define.active'))
            ->paginate(config('define.paginate'));
    }
}
