<?php


namespace App\Repositories\Interfaces;


use App\Models\Category;

interface ProductRepositoryInterface
{
    public function all();
    public function update(array $data, int $id);
    public function create(array $data);
    public function whereCategory(array $categoryIds);
}
