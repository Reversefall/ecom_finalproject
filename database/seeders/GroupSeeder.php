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
        // Retrieve all products from the database
        $products = Product::all();

        // Check if no products exist and stop the seeding process
        if ($products->isEmpty()) {
            $this->command->info('No products found. Run ProductSeeder first.');
            return;
        }

        // Set the creator ID (assumed to be an admin or system user)
        $creatorId = 3;

        // Define the groups to be created
        $groups = [
            [
                'group_name'  => 'iPhone Discount Purchase Group',
                'description' => 'Buy iPhones together to get wholesale prices.',
            ],
            [
                'group_name'  => 'Bulk T-shirt Purchase',
                'description' => 'Buy men\'s t-shirts at a cheaper price when buying in bulk.',
            ],
            [
                'group_name'  => 'Imported Cosmetics Purchase Group',
                'description' => 'Get quality cosmetics at a good price by pooling together.',
            ],
        ];

        // Create each group and assign a random product to it
        foreach ($groups as $data) {
            $group = Group::create([
                'creator_id' => $creatorId,
                'product_id' => $products->random()->product_id,
                'group_name' => $data['group_name'],
                'description' => $data['description'],
                'deadline' => now()->addDays(rand(3, 10)),  // Random deadline between 3 and 10 days
                'status' => 'processing',  // Default status of the group
                'max_quantity' => 10,  // Max quantity of members in the group
            ]);

            // Add the creator as the first member of the group
            GroupMember::create([
                'group_id' => $group->group_id,
                'customer_id' => $creatorId,
                'joined_at' => now(),
            ]);
        }

        // Output the success message with the number of groups created
        $this->command->info(count($groups) . ' groups have been successfully seeded!');
    }
}
