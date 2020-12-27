<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();

        $this->command->getOutput()->newLine();
        $this->command->getOutput()->progressStart(100000);

        for ($i = 0; $i < 1000; $i++) {
            $category = $categories->random();
            Product::factory()->count(100)->create(['category_id' => $category->id]);
            $this->command->getOutput()->progressAdvance(100);
        }

        $this->command->getOutput()->progressFinish();
    }
}
