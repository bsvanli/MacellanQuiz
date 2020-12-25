<?php


namespace App\Repositories\Interfaces;


interface ProductRepositoryInterface
{
    public function all();
    public function update(array $data, array $categories, int $id);
    public function create(array $data, array $categories);
}
