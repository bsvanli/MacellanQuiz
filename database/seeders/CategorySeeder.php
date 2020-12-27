<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->count(3)->create()->each(function (Category $category) {
            Category::factory()->count(1)->create(['parent_id' => $category->id])->each(function (Category $category) {
                Category::factory()->count(1)->create(['parent_id' => $category->id]);
            });
        });
    }
}
