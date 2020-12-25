<?php

namespace App\Http\Controllers\Panel\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function all()
    {
        try {
            $products = Product::with('categories')->select('products.*');
            return datatables()
                ->eloquent($products)
                ->editColumn('categories', function(Product $product){
                    $names = array_map(function($e) {
                        return $e['name'];
                    }, $product->categories->toArray());
                    return implode(', ', $names);
                })
                ->toJson();
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Hata oluştu'
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function add(ProductRequest $request)
    {
        $data = [
            'name'      => $request->get('name'),
            'price' => $request->get('price')
        ];
        if ($this->productRepository->create($data, $request->get('category'))) {
            return response()->json([
                'status'  => true,
                'message' => 'Ürün eklendi',
                'data'    => [
                    'redirect' => route('panel.product.all')
                ]
            ], JsonResponse::HTTP_CREATED);
        }

        return response()->json([
            'status'  => false,
            'message' => 'Hata oluştu'
        ], JsonResponse::HTTP_CREATED);
    }

    public function update(Product $product, ProductRequest $request)
    {
        $data = [
            'name'      => $request->get('name'),
            'price' => $request->get('price')
        ];
        if ($this->productRepository->update($data, $request->get('category'), $product->id)) {
            return response()->json([
                'status'  => true,
                'message' => 'Ürün güncellendi',
                'data'    => [
                    'redirect' => route('panel.product.all')
                ]
            ], JsonResponse::HTTP_CREATED);
        }

        return response()->json([
            'status'  => false,
            'message' => 'Hata oluştu'
        ], JsonResponse::HTTP_CREATED);
    }
}
