<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;
use App\Models\Product;
use App\Models\GroupMember;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        if ($products->isEmpty()) {
            $this->command->info('No products found. Run ProductSeeder first.');
            return;
        }

        $creatorId = 3;

        $groups = [
            [
                'group_name'  => 'Nhóm mua iPhone giá tốt',
                'description' => 'Cùng nhau mua iPhone để nhận giá sỉ.',
            ],
            [
                'group_name'  => 'Mua áo thun số lượng lớn',
                'description' => 'Mua áo thun nam với giá rẻ khi mua nhiều.',
            ],
            [
                'group_name'  => 'Nhóm mua mỹ phẩm xách tay',
                'description' => 'Cùng gom mỹ phẩm chất lượng giá tốt.',
            ],
        ];

        foreach ($groups as $data) {
            $group = Group::create([
                'creator_id' => $creatorId,
                'product_id' => $products->random()->product_id,
                'group_name' => $data['group_name'],
                'description' => $data['description'],
                'deadline' => now()->addDays(rand(3, 10)),
                'status' => 'processing',
            ]);

            GroupMember::create([
                'group_id' => $group->group_id,
                'customer_id' => $creatorId,
                'joined_at' => now(),
            ]);
        }

        $this->command->info(count($groups) . ' groups đã được seed thành công!');
    }
}
