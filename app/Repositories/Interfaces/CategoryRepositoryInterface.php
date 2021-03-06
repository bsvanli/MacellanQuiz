<?php


namespace App\Repositories\Interfaces;


interface CategoryRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function update(array $data, int $id);
    public function getIdsWithSubCategories($categories, $id);
}
