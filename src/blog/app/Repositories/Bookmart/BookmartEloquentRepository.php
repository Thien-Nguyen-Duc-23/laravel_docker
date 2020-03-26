<?php
namespace App\Repositories\Bookmart;

use App\Repositories\EloquentRepository;
use App\Repositories\Bookmart\BookmartRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\Bookmart;
use App\Models\UserInformation;

class BookmartEloquentRepository extends EloquentRepository implements BookmartRepositoryInterface
{
    public function getModel()
    {
        return Bookmart::class;
    }

    public function getBookmarkOfUserPaginate($userId)
    {
        return $this->model::where('user_id', $userId)
                            ->orderBy('created_at', 'desc')
                            ->paginate(config('define.paginate'));
    }

    public function getBookmartOfUser($bookId)
    {
        return $this->model::where('book_id', $bookId)->first();
    }

    public function getTopBookFollow()
    {
        return $this->model::select('book_id', DB::raw('COUNT(book_id) as total'))
                            ->groupBy('book_id')
                            ->orderBy('total', 'DESC')
                            ->limit(5)
                            ->get();
    }

    public function getUserFollowOfBook($bookId)
    {
        return $this->model::select('user_informations.*', 'bookmarts.*')
                            ->join('user_informations', 'user_informations.id', '=', 'bookmarts.user_id')
                            ->where('bookmarts.book_id', $bookId)
                            ->get();
    }
}
