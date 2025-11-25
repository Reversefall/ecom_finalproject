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
        $seller = User::where('username', 'seller')->first();

        if (!$seller) {
            $this->command->info('Seller user not found, aborting seeder.');
            return;
        }

        $categories = Category::all()->keyBy('category_name');

        $products = [
            'Điện thoại' => ['iPhone 15', 'Samsung Galaxy S23'],
            'Quần áo'    => ['Áo thun nam', 'Váy nữ'],
            'Đồ chơi'    => ['Lego City', 'Búp bê Barbie'],
            'Mỹ phẩm'    => ['Son môi Dior', 'Kem dưỡng da'],
            'Mô hình'    => ['Mô hình Gundam', 'Mô hình ô tô'],
        ];

        foreach ($products as $categoryName => $items) {
            if (!isset($categories[$categoryName])) {
                $this->command->info("Category $categoryName not found, skipping...");
                continue;
            }

            $categoryId = $categories[$categoryName]->category_id;

            foreach ($items as $itemName) {
                $product = Product::create([
                    'product_name'     => $itemName,
                    'category_id'      => $categoryId,
                    'price'            => rand(100000, 1000000),
                    'current_quantity' => rand(1, 50),
                    'status'           => 1,
                    'seller_id'        => $seller->id,
                ]);

                $imageCount = rand(1, 3);
                for ($j = 1; $j <= $imageCount; $j++) {
                    ProductImage::create([
                        'product_id' => $product->product_id,
                        'image_url'  => 'https://cdn2.cellphones.com.vn/x/media/catalog/product/d/o/download_2__1_27.png',
                    ]);
                }
            }
        }

        $this->command->info('10 sản phẩm của seller đã được seed thành công!');
    }
}
