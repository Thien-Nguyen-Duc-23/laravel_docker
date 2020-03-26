<?php
namespace App\Repositories\Bookmart;

interface BookmartRepositoryInterface
{
    public function getBookmarkOfUserPaginate($userId);
    public function getBookmartOfUser($bookId);

    public function getTopBookFollow();
    
    public function getUserFollowOfBook($bookId);
}
