<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BookService;
use App\Http\Requests\Admin\UpdateBookRequest;
use Exception;
use App\Http\Requests\Admin\StoreBookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $books;
    
    // inject BookService in construct
    public function __construct(BookService $bookService)
    {
        $this->books = $bookService;
    }

    // get all accounts
    public function index()
    {
        try {
            $getAllBook = $this->books->getAllBook();
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return view('admin.books.view', compact('getAllBook'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $getChildrenCategory = $this->books->getCategory();
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return view('admin.books.insert', compact('getChildrenCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $getBook = $this->books->editBook($id);
            $getChildrenCategory = $this->books->getAllCate($getBook->category->id);
        } catch (Exeption $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return view('admin.books.edit', compact('getBook', 'getChildrenCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, $id)
    {
        try {
            $result = $this->books->updateBook($id, $request);
        } catch (Exeption $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        if ($result) {
            return redirect()->route('books.index')->with(['flag' => 'success', 'message' => 'Update Book Success!!']);
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Update Book Fail!!']);
        }
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        try {
            $result = $this->books->storeBook($request);
        } catch (Exception $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }

        if ($result) {
            return redirect()->back()->with(['flag' => 'success', 'message' => 'Insert Book Success!!']);
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Insert Book Fail!!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $result = $this->books->deleteBook($id);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        if ($result) {
            return redirect()->back()->with(['flag' => 'success', 'message' => 'Delete Book Success!!']);
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Delete Book Fail!!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $getBook = $this->books->show($id);
        } catch (Exeption $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return view('admin.books.show', compact('getBook'));
    }
}
