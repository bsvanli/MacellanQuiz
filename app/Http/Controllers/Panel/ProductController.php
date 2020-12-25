<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    private CategoryRepository $categoryRepository;
    private ProductRepository $productRepository;

    public function __construct(CategoryRepository $categoryRepository, ProductRepository $productRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function all()
    {
        return view('panel.product.all');
    }

    public function add()
    {
        return view('panel.product.edit')
            ->with([
                'categories' => $this->categoryRepository->all(),
                'endpoint'   => route('panel.product.ajax.add')
            ]);
    }

    public function edit(Product $product)
    {
        view()->share('categoryIds', array_column($product->categories->toArray(), 'id'));

        Log::debug(print_r(array_column($product->categories->toArray(), 'id'),true));

        return view('panel.product.edit')
            ->with([
                'product'   => $product,
                'categories' => $this->categoryRepository->all(),
                'endpoint'   => route('panel.product.ajax.update', $product->id)
            ]);
    }
}
