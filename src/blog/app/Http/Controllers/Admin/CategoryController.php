<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $category;

    public function __construct(CategoryService $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        try {
            $items = $this->category->getTreeCategory();
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return view('admin.categories.index')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $getParentCategory = $this->category->getParentCategory();
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return view('admin.categories.insert', compact('getParentCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $result = $this->category->storeCategory($request);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        if ($result) {
            return redirect()->route('categories.index')->with(['flag' => 'success', 'message' => 'Insert Category Success!!']);
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Insert Category Fail!!']);
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
        //
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
            $getCategory = $this->category->find($id);
            $getParentCategory = $this->category->getParentCategory();
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return view('admin.categories.update', compact(['getParentCategory', 'getCategory']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        try {
            $result = $this->category->updateCategory($id, $request);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        if ($result) {
            return redirect()->route('categories.index')->with(['flag' => 'success', 'message' => 'Update Category Success!!']);
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Update Category Fail!!']);
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
            $result = $this->category->deleteCategory($id);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        if ($result) {
            return redirect()->back()->with(['flag' => 'success', 'message' => 'Delete Category Success!!']);
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Delete Category Fail!!']);
        }
    }
}
