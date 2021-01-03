<?php


namespace App\Services;


use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Log;

class CategoryService
{

    private $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function calculateProductCounts(): void
    {
        $categories = $this->categoryRepo->getRootCategories()->toArray();
        $this->each($categories);
    }

    private function each(array $categories): void
    {
        foreach ($categories as $category) {
            $this->categoryRepo
                ->update(
                    [
                        'total_count' => $this->getCountWithChildren($category)
                    ],
                    $category['id']);
            $this->each($category['children']);
        }
    }

    private function getCountWithChildren($category): int
    {
        $productCount = $category['products_count'];
        array_walk_recursive($category['children'], function ($val, $key) use (&$productCount) {
            $productCount += $key == 'products_count' ? $val : 0;
        });
        return $productCount;
    }


}
