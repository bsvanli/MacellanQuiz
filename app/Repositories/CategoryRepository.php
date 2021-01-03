<?php


namespace App\Repositories;


use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{

    private Category $model;

    private array $ids = [];

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function getRootCategories(){
        return $this->model
            ->withCount('products')
            ->with('children')
            ->whereNull('parent_id')
            ->get();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, int $id)
    {
        return $this->model->find($id)->update($data);
    }

    public function getIdsWithSubCategories($categories, $id)
    {
        $this->ids = [];
        return $this->recursiveSubCategoryIds($categories, $id);

    }


    public function recursiveSubCategoryIds($categories, $id): array
    {
        $this->ids[] = $id;
        foreach ($categories->where('parent_id', $id) as $cat) {
            $this->recursiveSubCategoryIds($categories, $cat->id);
        }
        return $this->ids;
    }


}
