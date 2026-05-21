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
                'name' => 'John Deere',
                'description' => 'Agricultural machinery and heavy-duty farm equipment.',
            ],
            [
                'name' => 'Kubota',
                'description' => 'Compact tractors, utility vehicles, and agricultural machinery.',
            ],
            [
                'name' => 'New Holland',
                'description' => 'Modern farming equipment for harvesting, baling, and field work.',
            ],
            [
                'name' => 'Case IH',
                'description' => 'Powerful machines for professional agricultural operations.',
            ],
            [
                'name' => 'Massey Ferguson',
                'description' => 'Reliable tractors and farm equipment for different workloads.',
            ],
        ];

        foreach ($brands as $brand) {
            Brand::query()->updateOrCreate(
                ['slug' => Str::slug($brand['name'])],
                [
                    'name' => $brand['name'],
                    'description' => $brand['description'],
                    'logo' => null,
                    'is_active' => true,
                ]
            );
        }
    }
}
