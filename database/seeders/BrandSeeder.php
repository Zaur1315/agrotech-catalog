<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

final class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Caterpillar',
                'description' => 'Heavy equipment for construction, utility, loader and backhoe applications.',
            ],
            [
                'name' => 'Case',
                'description' => 'Backhoes, tractors and jobsite equipment for agricultural and commercial use.',
            ],
            [
                'name' => 'Komatsu',
                'description' => 'Construction and material handling equipment for demanding working conditions.',
            ],
            [
                'name' => 'Bobcat',
                'description' => 'Compact equipment and tracked loaders for jobsite, land and utility work.',
            ],
            [
                'name' => 'John Deere',
                'description' => 'Agricultural tractors, compact loaders and equipment for farm and field operations.',
            ],
            [
                'name' => 'New Holland',
                'description' => 'Farm tractors and agricultural equipment for field, loader and utility work.',
            ],
        ];

        $allowedSlugs = collect($brands)
            ->pluck('name')
            ->map(static fn (string $name): string => Str::slug($name))
            ->all();

        Brand::query()
            ->whereNotIn('slug', $allowedSlugs)
            ->delete();

        foreach ($brands as $brand) {
            Brand::query()->updateOrCreate(
                ['slug' => Str::slug($brand['name'])],
                [
                    'name' => $brand['name'],
                    'description' => $brand['description'],
                    'logo' => null,
                    'is_active' => true,
                ],
            );
        }
    }
}
