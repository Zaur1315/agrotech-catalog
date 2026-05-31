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
                'name' => 'Backhoes',
                'description' => 'Used backhoe loaders for digging, trenching, loading and jobsite utility work.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Wheel Loaders',
                'description' => 'Wheel loaders for material handling, loading, site work and commercial equipment operations.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Skid Steer Loaders',
                'description' => 'Tracked skid steer loaders for grading, loading, land work and compact jobsite access.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Tractors',
                'description' => 'MFWD tractors for farm, field, hay, loader and utility applications.',
                'sort_order' => 4,
            ],
        ];

        $allowedSlugs = collect($categories)
            ->pluck('name')
            ->map(static fn (string $name): string => Str::slug($name))
            ->all();

        Category::query()
            ->whereNotIn('slug', $allowedSlugs)
            ->delete();

        foreach ($categories as $category) {
            Category::query()->updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'image' => null,
                    'is_active' => true,
                    'sort_order' => $category['sort_order'],
                ],
            );
        }
    }
}
