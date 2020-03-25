<?php
namespace App\Repositories\Comments;

interface CommentRepositoryInterface
{
    public function getReviews();
    public function getCommentPaginate($bookId);

    public function getCommentNonAccept($quatily);
}
