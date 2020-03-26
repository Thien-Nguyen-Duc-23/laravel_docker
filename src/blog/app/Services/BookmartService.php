<?php
namespace App\Services;

use App\Repositories\Bookmart\BookmartRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Bookmart;
use Auth;

class BookmartService
{
    protected $bookmart;
    
    // inject BookmartRepositoryInterface in construct
    public function __construct(BookmartRepositoryInterface $bookmart)
    {
        $this->bookmart = $bookmart;
    }

    // function getBookmartOfUser
    public function getBookmartOfUser($idBook)
    {
        return $this->bookmart->getBookmartOfUser($idBook);
    }

    // function storeBookmart
    public function storeBookmart(Request $request)
    {
        $attributes = [
            'book_id' => $request->book_id,
            'user_id' => Auth::guard('client')->user()->userInformation->id,
        ];

        $result = $this->bookmart->create($attributes);

        return $result;
    }

    // function destroyBookmart
    public function destroyBookmart($id)
    {
        return $this->bookmart->delete($id);
    }
}
