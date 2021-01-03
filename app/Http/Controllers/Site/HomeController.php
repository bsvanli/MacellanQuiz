<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;

class HomeController extends Controller
{
    private CategoryRepository $categoryRepository;
    private ProductRepository $productRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function index(Category $category = null)
    {
        $categories = $this->categoryRepository->all();

        $products = $this->productRepository;
        if($category){
            $products = $products->whereCategory($this->categoryRepository->getIdsWithSubCategories($categories, $category->id));
        }
        $products = $products->paginate(20);


        return view('site.home')
            ->with([
                'categories' => $categories,
                'cat'        => $category,
                'products'   => $products
            ]);

    }

}
