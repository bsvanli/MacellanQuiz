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

    public function all()
    {
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

    public function whereCategory(array $categories)
    {

        return $this->model->whereIn('category_id', $categories);
    }

    public function paginate($limit)
    {
        return $this->model->paginate($limit);
    }
}
