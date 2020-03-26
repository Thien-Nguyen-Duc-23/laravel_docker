<?php

namespace App\Services;

use App\Repositories\Category\CategoryRepositoryInterface as Cate;
use App\Models\Category;
use App\Charts\CountViewChart;
use App\Repositories\Bookmart\BookmartRepositoryInterface as Bookmart;
use App\Repositories\Accounts\AccountInterfaceRepository as Account;
use App\Repositories\Book\BookRepositoryInterface as Book;
use Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;

class DashboardService
{
    protected $category;
    protected $bookmart;
    protected $account;
    protected $book;

    //inject CategoryRepositoryInterface in contruct
    public function __construct(Cate $category, Bookmart $bookmart, Account $account, Book $book)
    {
        $this->category = $category;
        $this->bookmart = $bookmart;
        $this->account = $account;
        $this->book = $book;
    }

    // function report hits of book
    public function getReportHits()
    {
        $result = $this->category->getReportHits();

        $labels = $result->pluck('name');
        $values = $result->pluck('total');

        $rand = [];
        for ($i = 0; $i<= $result->count(); $i++) {
            $rand[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        }

        $chart = new CountViewChart();
        $chart->labels($labels);
        $chart->dataset('Report', 'pie', $values)->backgroundColor($rand);

        return $chart;
    }

    // function get top most book follow
    public function getTopBookFollow()
    {
        return $this->bookmart->getTopBookFollow();
    }

    // get user follow of book
    public function getUserFollowOfBook($bookId)
    {
        return $this->bookmart->getUserFollowOfBook($bookId);
    }

    // get total user of website
    public function totalUser()
    {
        return $this->account->getAll()->count();
    }

    // get total book of website
    public function totalBook()
    {
        return $this->book->getAll()->count();
    }

    // get total category of website
    public function totalCategory()
    {
        return $this->category->getAll()->count();
    }

    // function get top 3 most book by view
    public function getTopBookByView()
    {
        return $this->book->getBookByView(3);
    }

    // function get top 3 most book by rating
    public function getTopBookByRate()
    {

        return $this->book->getSortByRate()->take(3);
    }

    // function report this year access number
    public function accessYear()
    {
        // dd('thien');
        $analyticsData = Analytics::performQuery(Period::years(1), 'ga:sessions', [
            'metrics' => 'ga:pageviews',
            'dimensions' => 'ga:yearMonth',
        ]);

        // dd($analyticsData);
        $result = $analyticsData;
        $labels = collect($result)->pluck('0')->toArray();
        $values = collect($result)->pluck('1');

        for ($i = 0; $i < count($labels); $i++) {
            $date[$i] = Carbon::createFromFormat('Ym', $labels[$i])->format('M, Y');
        }

        $chart = new CountViewChart();
        $chart->labels($date);
        $chart->dataset('Number vister of month', 'bar', $values)->backgroundColor('#4d2673');

        return $chart;
    }
}
