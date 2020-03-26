<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Bookmart\BookmartRepositoryInterface;
use Auth;

class BookmartController extends Controller
{
    protected $bookmart;

    public function __construct(BookmartRepositoryInterface $bookmart)
    {
        $this->bookmart = $bookmart;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::guard('client')->user()->userInformation->id;

        try {
            $bookmarks = $this->bookmart->getBookmarkOfUserPaginate($userId);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        
        return view('client.bookmark.index', compact('bookmarks'));
    }
}
