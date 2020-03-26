<?php
namespace App\Repositories\Comments;

use App\Repositories\EloquentRepository;
use App\Models\Comment;

class CommentEloquentRepository extends EloquentRepository implements CommentRepositoryInterface
{
    public function getModel()
    {
        return Comment::class;
    }

    public function getReviews()
    {
        return $this->model::orderBy('created_at', 'desc')->get();
    }
    
    public function getCommentPaginate($bookId)
    {
        return $this->model::where([['book_id', '=', $bookId], ['status', '=', config('define.active')]])
                            ->orderBy('created_at', 'desc')->paginate(config('define.paginate'));
    }

    public function getCommentNonAccept($quatily)
    {
        return $this->model::where('status', config('define.disable'))
                            ->orderBy('created_at', 'desc')
                            ->take($quatily)
                            ->get();
    }
}
