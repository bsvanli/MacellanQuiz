<?php


namespace App\Repositories;


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
        return $this->model->with('categories')->get();
    }


    public function update(array $data, array $categories, int $id)
    {
        $update = $this->model->where('id', $id)->update($data);

        if($update){
            $product = $this->model->find($id);
            $product->categories()->sync($categories);
        }
        return $update;
    }

    public function create(array $data, array $categories)
    {
        $product = $this->model->create($data);

        $product->categories()->sync($categories);

        return $product;
    }
}
