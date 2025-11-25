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
                'category_name' => 'Điện thoại',
                'category_desc' => 'Các loại điện thoại thông minh và phụ kiện',

            ],
            [
                'category_name' => 'Quần áo',
                'category_desc' => 'Thời trang nam, nữ và trẻ em',

            ],
            [
                'category_name' => 'Đồ chơi',
                'category_desc' => 'Đồ chơi cho trẻ em các loại',

            ],
            [
                'category_name' => 'Mỹ phẩm',
                'category_desc' => 'Sản phẩm làm đẹp, chăm sóc da và trang điểm',
            ],
            [
                'category_name' => 'Mô hình',
                'category_desc' => 'Mô hình xe, mô hình nhân vật, đồ sưu tầm',

            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
