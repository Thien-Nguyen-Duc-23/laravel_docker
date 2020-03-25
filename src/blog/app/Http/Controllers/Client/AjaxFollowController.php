<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BookmartService;
use Exception;

class AjaxFollowController extends Controller
{
    protected $bookmart;

    public function __construct(BookmartService $bookmart)
    {
        $this->bookmart = $bookmart;
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function follow(Request $request)
    {
        $idBook = $request->book_id;
        try {
            $result = $this->bookmart->storeBookmart($request);
            $bookmart = $this->bookmart->getBookmartOfUser($idBook);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        $idBookmart = $result->id;

        if ($result) {
            return view('client.books.follow', compact('bookmart', 'idBook', 'idBookmart'));
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Follow Fail!!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unfollow($id, $bookId)
    {
        try {
            $result = $this->bookmart->destroyBookmart($id);
            $bookmart = $this->bookmart->getBookmartOfUser($bookId);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        
        if ($result) {
            return view('client.books.unfollow', compact('bookmart', 'bookId'));
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Delete Bookmark Fail!!']);
        }
    }
}
