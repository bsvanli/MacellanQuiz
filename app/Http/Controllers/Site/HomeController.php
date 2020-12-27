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

        $products = $this->productRepository
            ->whereCategory($category)
            ->paginate(20);


        return view('site.home')
            ->with([
                'categories' => $this->categoryRepository->all(),
                'cat'        => $category,
                'products'   => $products
            ]);

    }

}
