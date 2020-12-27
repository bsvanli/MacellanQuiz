<?php


namespace App\Repositories;


use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{

    private Category $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function all(){
        return $this->model->with('children')->whereNull('parent_id')->get();
    }

    public function create($data){
        return $this->model->create($data);
    }

    public function update(array $data, int $id)
    {
        return $this->model->find($id)->update($data);
    }


}
