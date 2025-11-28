<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Find the seller user by username
        $seller = User::where('username', 'seller')->first();

        // If no seller user is found, abort the seeding process
        if (!$seller) {
            $this->command->info('Seller user not found, aborting seeder.');
            return;
        }

        // Get all categories indexed by their category name
        $categories = Category::all()->keyBy('category_name');

        // Define products in various categories
        $products = [
            'Phones'     => ['iPhone 15', 'Samsung Galaxy S23'],
            'Clothing'   => ['Men\'s T-shirt', 'Women\'s Dress'],
            'Toys'       => ['Lego City', 'Barbie Doll'],
            'Cosmetics'  => ['Dior Lipstick', 'Face Cream'],
            'Models'     => ['Gundam Model', 'Car Model'],
        ];

        // Loop through each category and create products
        foreach ($products as $categoryName => $items) {
            // If the category is not found, skip to the next one
            if (!isset($categories[$categoryName])) {
                $this->command->info("Category $categoryName not found, skipping...");
                continue;
            }

            // Get the category ID based on the category name
            $categoryId = $categories[$categoryName]->category_id;

            // Create products in the given category
            foreach ($items as $itemName) {
                // Create a new product
                $product = Product::create([
                    'product_name'     => $itemName,
                    'category_id'      => $categoryId,
                    'price'            => rand(100000, 1000000),  // Random price between 100,000 and 1,000,000
                    'current_quantity' => rand(1, 50),            // Random quantity between 1 and 50
                    'status'           => 1,                       // Product status (active)
                    'seller_id'        => $seller->id,            // Seller ID
                ]);

                // Generate a random number of product images (between 1 and 3)
                $imageCount = rand(1, 3);
                for ($j = 1; $j <= $imageCount; $j++) {
                    // Create product image entries
                    ProductImage::create([
                        'product_id' => $product->product_id,
                        'image_url'  => 'https://cdn2.cellphones.com.vn/x/media/catalog/product/d/o/download_2__1_27.png',
                    ]);
                }
            }
        }

        // Output a success message indicating how many products were seeded
        $this->command->info('10 products for the seller have been successfully seeded!');
    }
}
