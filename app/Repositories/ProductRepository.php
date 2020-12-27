<?php


namespace App\Repositories;


use App\Models\Category;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    private Product $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function all(){
        return $this->model->with('category')->get();
    }


    public function update(array $data, int $id)
    {
        return $this->model->find($id)->update($data);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function whereCategory(Category $category = null){

        if($category){
            return $this->model->whereIn('category_id', $category->childCategoryIds);
        }

        return $this->model;
    }

    public function countByCategory($categoryId){
        return $this->model->where('category_id', $categoryId)->count();
    }

    public function paginate($limit){
        return $this->model->paginate($limit);
    }
}
