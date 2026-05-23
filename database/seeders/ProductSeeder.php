<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

final class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'category' => 'Tractors',
                'brand' => 'John Deere',
                'name' => 'John Deere 5075E Utility Tractor',
                'image' => 'images/demo/tractor-1.jpg',
                'sku' => 'JD-5075E',
                'price' => 42900,
                'year' => 2023,
                'condition' => Product::CONDITION_NEW,
                'engine' => '75 HP Diesel',
                'transmission' => '9F/3R SyncShuttle',
                'fuel_type' => 'Diesel',
                'hours_used' => 12,
                'is_featured' => true,
                'attributes' => [
                    'Horsepower' => '75 HP',
                    'Drive Type' => '4WD',
                    'Loader Ready' => 'Yes',
                    'Warranty' => '24 months',
                ],
            ],
            [
                'category' => 'Tractors',
                'brand' => 'Kubota',
                'name' => 'Kubota L3902 Compact Tractor',
                'image' => 'images/demo/tractor-2.jpg',
                'sku' => 'KB-L3902',
                'price' => 28900,
                'year' => 2024,
                'condition' => Product::CONDITION_NEW,
                'engine' => '37.5 HP Diesel',
                'transmission' => 'HST',
                'fuel_type' => 'Diesel',
                'hours_used' => 5,
                'is_featured' => true,
                'attributes' => [
                    'Horsepower' => '37.5 HP',
                    'Drive Type' => '4WD',
                    'PTO Power' => '30.3 HP',
                    'Warranty' => '24 months',
                ],
            ],
            [
                'category' => 'Harvesters',
                'brand' => 'New Holland',
                'name' => 'New Holland CR7.90 Combine Harvester',
                'image' => 'images/demo/harvester-1.jpg',
                'sku' => 'NH-CR790',
                'price' => 189000,
                'year' => 2021,
                'condition' => Product::CONDITION_USED,
                'engine' => 'Cursor 9 Diesel',
                'transmission' => 'Hydrostatic',
                'fuel_type' => 'Diesel',
                'hours_used' => 820,
                'is_featured' => true,
                'attributes' => [
                    'Header Width' => '30 ft',
                    'Grain Tank' => '315 bu',
                    'Rotor Type' => 'Twin Rotor',
                    'Condition Notes' => 'Field ready',
                ],
            ],
            [
                'category' => 'Utility Vehicles',
                'brand' => 'John Deere',
                'name' => 'John Deere Gator XUV835M',
                'image' => 'images/demo/utility-vehicle-1.jpg',
                'sku' => 'JD-XUV835M',
                'price' => 21900,
                'year' => 2023,
                'condition' => Product::CONDITION_USED,
                'engine' => '812cc Gas',
                'transmission' => 'CVT',
                'fuel_type' => 'Gasoline',
                'hours_used' => 146,
                'is_featured' => false,
                'attributes' => [
                    'Seats' => '3',
                    'Cargo Capacity' => '1000 lb',
                    'Drive Type' => '4WD',
                    'Cab' => 'Enclosed',
                ],
            ],
            [
                'category' => 'Balers',
                'brand' => 'Case IH',
                'name' => 'Case IH RB565 Premium Round Baler',
                'image' => 'images/demo/baler-1.jpg',
                'sku' => 'CIH-RB565',
                'price' => 57900,
                'year' => 2022,
                'condition' => Product::CONDITION_USED,
                'engine' => null,
                'transmission' => null,
                'fuel_type' => null,
                'hours_used' => null,
                'is_featured' => false,
                'attributes' => [
                    'Bale Size' => '5x6',
                    'Pickup Width' => '82 in',
                    'Twine' => 'Yes',
                    'Net Wrap' => 'Yes',
                ],
            ],
            [
                'category' => 'Attachments',
                'brand' => 'Massey Ferguson',
                'name' => 'Massey Ferguson Front Loader Attachment',
                'image' => 'images/demo/attachment-1.jpg',
                'sku' => 'MF-FL001',
                'price' => 6900,
                'year' => 2024,
                'condition' => Product::CONDITION_NEW,
                'engine' => null,
                'transmission' => null,
                'fuel_type' => null,
                'hours_used' => null,
                'is_featured' => false,
                'attributes' => [
                    'Lift Capacity' => '2200 lb',
                    'Compatible Models' => 'MF 1800 Series',
                    'Bucket Included' => 'Yes',
                    'Hydraulic Lines' => 'Included',
                ],
            ],
        ];

        foreach ($products as $productData) {
            $category = Category::query()
                ->where('name', $productData['category'])
                ->firstOrFail();

            $brand = Brand::query()
                ->where('name', $productData['brand'])
                ->firstOrFail();

            $product = Product::query()->updateOrCreate(
                ['sku' => $productData['sku']],
                [
                    'category_id' => $category->id,
                    'brand_id' => $brand->id,
                    'name' => $productData['name'],
                    'slug' => Str::slug($productData['name']),
                    'short_description' => $this->makeShortDescription($productData['name']),
                    'description' => $this->makeDescription($productData['name']),
                    'price' => $productData['price'],
                    'price_on_request' => false,
                    'year' => $productData['year'],
                    'condition' => $productData['condition'],
                    'engine' => $productData['engine'],
                    'transmission' => $productData['transmission'],
                    'fuel_type' => $productData['fuel_type'],
                    'hours_used' => $productData['hours_used'],
                    'main_image' => $productData['image'],
                    'is_featured' => $productData['is_featured'],
                    'is_active' => true,
                ]
            );

            ProductImage::query()->updateOrCreate(
                [
                    'product_id' => $product->id,
                    'sort_order' => 1,
                ],
                [
                    'path' => $productData['image'],
                    'alt' => $product->name,
                ]
            );

            $sortOrder = 1;

            foreach ($productData['attributes'] as $name => $value) {
                ProductAttribute::query()->updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'name' => $name,
                    ],
                    [
                        'value' => $value,
                        'sort_order' => $sortOrder,
                    ]
                );

                $sortOrder++;
            }
        }
    }

    private function makeShortDescription(string $productName): string
    {
        return sprintf(
            '%s is a reliable agricultural machine designed for demanding daily farm operations.',
            $productName
        );
    }

    private function makeDescription(string $productName): string
    {
        return sprintf(
            '%s offers a practical balance of performance, durability, and operator comfort. This unit is suitable for farms, contractors, and agricultural businesses looking for dependable equipment with strong field productivity.',
            $productName
        );
    }
}
