<?php
namespace App\Repositories\Category;

interface CategoryRepositoryInterface
{
    public function getParentCategory();

    public function getTreeCategory();

    public function getFourCategories();

    public function getAllCategories();

    // public function getReportHits();
}
