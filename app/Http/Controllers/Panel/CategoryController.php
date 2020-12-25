<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function all()
    {
        return view('panel.category.all');
    }

    public function add()
    {
        return view('panel.category.edit')
            ->with([
                'categories' => $this->categoryRepository->all(),
                'endpoint'   => route('panel.category.ajax.add')
            ]);
    }

    public function edit(Category $category)
    {
        view()->share('id', $category->parent_id);

        return view('panel.category.edit')
            ->with([
                'category'   => $category,
                'categories' => $this->categoryRepository->all(),
                'endpoint'   => route('panel.category.ajax.update', $category->id)
            ]);
    }
}
