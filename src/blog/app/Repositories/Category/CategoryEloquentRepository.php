<?php
namespace App\Repositories\Category;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoryEloquentRepository extends EloquentRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function getParentCategory()
    {
        return $this->model::whereNull('parent_id')->select('name', 'id')->get();
    }

    public function getTreeCategory()
    {
        return $this->model::with(implode('.', array_fill(0, 4, 'children')))->whereNull('parent_id')->get();
    }

    public function getFourCategories()
    {
        return $this->model::whereNull('parent_id')->take(4)->get();
    }

    public function getReportHits()
    {
        return $this->model
                    ->select('categories.name', DB::raw('SUM(view_count) as total'), 'books.category_id as idCate')
                    ->join('books', 'categories.id', '=', 'books.category_id')
                    ->groupBy('idCate')
                    ->get();
    }
}
