<?php

namespace App\Http\Controllers\Panel\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\JsonResponse;
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
        try {
            return datatables()->eloquent(Category::query())->toJson();
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Hata oluştu'
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function add(CategoryRequest $request)
    {
        $data = [
            'parent_id' => $request->get('category'),
            'name'      => $request->get('name')
        ];
        if ($this->categoryRepository->create($data)) {
            return response()->json([
                'status'  => true,
                'message' => 'Kategori eklendi',
                'data'    => [
                    'redirect' => route('panel.category.all')
                ]
            ], JsonResponse::HTTP_CREATED);
        }

        return response()->json([
            'status'  => false,
            'message' => 'Hata oluştu'
        ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function update(Category $category, CategoryRepository $categoryRepository, CategoryRequest $request)
    {

        $categories = $categoryRepository->all();
        if(in_array($request->get('category'), $categoryRepository->getIdsWithSubCategories($categories, $category->id))){
            return response()->json([
                'status'  => false,
                'message' => 'Alt kategorisi kendisi olamaz'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $data = [
            'parent_id' => $request->get('category'),
            'name'      => $request->get('name')
        ];
        if ($this->categoryRepository->update($data, $category->id)) {
            return response()->json([
                'status'  => true,
                'message' => 'Kategori güncellendi',
                'data'    => [
                    'redirect' => route('panel.category.all')
                ]
            ], JsonResponse::HTTP_CREATED);
        }

        return response()->json([
            'status'  => false,
            'message' => 'Hata oluştu'
        ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }
}
