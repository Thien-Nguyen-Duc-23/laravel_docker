<?php
namespace App\Repositories\Book;

interface BookRepositoryInterface
{
    public function getRandomBook($quantity);

    public function getLatestBook();

    public function getBookPaginate();

    public function getBookByView($quantity);

    public function getBookActive();

    public function getSortByComment();

    public function getSortByRate();
}
