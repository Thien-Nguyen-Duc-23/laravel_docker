<?php

namespace App\Services;

use App\Repositories\Category\CategoryRepositoryInterface;
use App\Models\Category;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Helpers\AdminHelper;

class CategoryService
{
    protected $category;

    //inject CategoryRepositoryInterface in contruct
    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->category = $category;
    }

    //Get parent category
    public function getParentCategory()
    {
        return $this->category->getParentCategory();
    }

    //Store a newky Category
    public function storeCategory(StoreCategoryRequest $request)
    {
        $fileUpload = $request->file('coverImage');
        $folder = 'public/admin/categories/';
        $colum = 'cover';

        $attributes = [
            'name' => $request->categoryName,
            'parent_id' => $request->parentCategory,
            'slug' => str_slug($request->categoryName),
        ];

        $result = $this->category->createUpload($attributes, $fileUpload, $folder, $colum, null);

        return $result;
    }

    //get list tree category
    public function getTreeCategory()
    {
        return $this->category->getTreeCategory();
    }

    public function find($id)
    {
        return $this->category->find($id);
    }

    public function updateCategory($id, UpdateCategoryRequest $request)
    {
        $attributes = [
            'name' => $request->editCategoryName,
            'parent_id' => $request->parentCategory,
            'slug' => str_slug($request->editCategoryName),
        ];

        if (is_null($request->file('editCoverImage'))) {
            return $this->category->update($id, $attributes);
        } else {
            $fileUpload = $request->file('editCoverImage');
            $folder = 'public/admin/categories/';
            $colum = 'cover';
            $oldFile = $request->oldFile;

            return $this->category->updateUpload($id, $attributes, $fileUpload, $folder, $colum, $oldFile, null);
        }
    }

    public function deleteCategory($id)
    {
        $folder = 'public/admin/categories/';
        $oldFile = $this->category->find($id)->cover;

        AdminHelper::deleteFile($folder, $oldFile);

        return $this->category->find($id)->delete();
    }

    //get first category by slug
    public function getFistSlugCategory($slug)
    {
        return $this->category->findSlug($slug)->first();
    }
}
