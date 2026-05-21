<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

final class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Tractors',
                'description' => 'Reliable tractors for farms, fields, and heavy-duty agricultural work.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Harvesters',
                'description' => 'High-performance harvesting machines for modern agriculture.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Utility Vehicles',
                'description' => 'Compact and durable utility vehicles for farm transportation.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Balers',
                'description' => 'Efficient balers for hay, straw, and forage operations.',
                'sort_order' => 4,
            ],
            [
                'name' => 'Attachments',
                'description' => 'Agricultural attachments and implements for different field tasks.',
                'sort_order' => 5,
            ],
        ];

        foreach ($categories as $category) {
            Category::query()->updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'image' => null,
                    'is_active' => true,
                    'sort_order' => $category['sort_order'],
                ]
            );
        }
    }
}
