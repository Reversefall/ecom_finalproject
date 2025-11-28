<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'category_name' => 'Mobile Phones',
                'category_desc' => 'Various types of smartphones and accessories',
            ],
            [
                'category_name' => 'Clothing',
                'category_desc' => 'Fashion for men, women, and children',
            ],
            [
                'category_name' => 'Toys',
                'category_desc' => 'Toys for children of all kinds',
            ],
            [
                'category_name' => 'Cosmetics',
                'category_desc' => 'Beauty products, skincare, and makeup',
            ],
            [
                'category_name' => 'Models',
                'category_desc' => 'Model cars, character models, and collectibles',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
