<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

final class ProductSeeder extends Seeder
{
    /**
     * @throws \Throwable
     */
    public function run(): void
    {
        DB::transaction(function (): void {

            foreach ($this->products() as $productData) {
                $category = Category::query()
                    ->where('name', $productData['category'])
                    ->firstOrFail();

                $brand = Brand::query()
                    ->where('name', $productData['brand'])
                    ->firstOrFail();

                $product = Product::query()->create([
                    'category_id' => $category->id,
                    'brand_id' => $brand->id,
                    'name' => $productData['name'],
                    'slug' => $productData['slug'],
                    'sku' => $productData['sku'],
                    'stock_number' => $productData['stock_number'],
                    'serial_number' => $productData['serial_number'],
                    'short_description' => $productData['short_description'],
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'price_on_request' => false,
                    'year' => $productData['year'],
                    'condition' => Product::CONDITION_USED,
                    'engine' => $productData['engine'],
                    'transmission' => $productData['transmission'],
                    'fuel_type' => 'Diesel',
                    'hours_used' => $productData['hours_used'],
                    'horsepower' => $productData['horsepower'],
                    'drive_type' => $productData['drive_type'],
                    'main_image' => $this->mainImagePath($productData['image_folder']),
                    'location' => config('site.city').', '.config('site.state'),
                    'status' => Product::STATUS_AVAILABLE,
                    'sort_order' => $productData['sort_order'],
                    'is_featured' => $productData['is_featured'],
                    'is_active' => true,
                ]);

                $this->createImages($product, $productData['image_folder']);
                $this->createAttributes($product, $productData['attributes']);
            }
        });
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function products(): array
    {
        return [
            [
                'category' => 'Backhoes',
                'brand' => 'Caterpillar',
                'name' => '2016 Caterpillar 420F2 IT Backhoe',
                'slug' => '2016-caterpillar-420f2-it-backhoe',
                'sku' => 'DY0799',
                'stock_number' => 'DY0799',
                'serial_number' => 'CAT0420FKHWD01108',
                'price' => 44800,
                'year' => 2016,
                'hours_used' => 3115,
                'horsepower' => null,
                'engine' => 'Caterpillar C4.4 4.4L diesel',
                'transmission' => 'Shuttle shift, 4F / 4R',
                'drive_type' => Product::DRIVE_TYPE_4WD,
                'image_folder' => '001-2016-caterpillar-420f2-it-backhoe',
                'is_featured' => true,
                'sort_order' => 1,
                'short_description' => 'Used 2016 Caterpillar 420F2 IT backhoe with enclosed cab, four wheel drive, loader, extendable stick and hydraulic thumb.',
                'description' => $this->description([
                    'This 2016 Caterpillar 420F2 IT backhoe is a used diesel backhoe loader with 3,115 hours showing on the meter.',
                    'The unit is equipped with an enclosed cab, heat and AC, pilot backhoe controls, pattern changer, four wheel drive, differential lock, hydraulic loader quick coupler, auxiliary hydraulics, extendable stick and hydraulic thumb.',
                    'It includes a Caterpillar loader bucket and Caterpillar backhoe bucket. Availability, final condition, hours and pricing should be confirmed directly before purchase.',
                ]),
                'attributes' => [
                    'Meter hours' => '3,115',
                    'Serial number' => 'CAT0420FKHWD01108',
                    'Engine' => 'Caterpillar C4.4',
                    'Displacement' => '4.4L',
                    'Cylinders' => '4',
                    'Fuel type' => 'Diesel',
                    'Transmission' => 'Shuttle shift, 4F / 4R',
                    'Drive' => 'Four wheel drive',
                    'Differential lock' => 'Yes',
                    'Cab' => 'Enclosed cab with AC and heat',
                    'Backhoe controls' => 'Pilot control with pattern changer',
                    'Loader quick coupler' => 'Hydraulic',
                    'Loader auxiliary hydraulics' => 'Yes',
                    'Loader bucket' => 'Caterpillar, 95" width, bolt-on cutting edge',
                    'Backhoe stick' => 'Extendable',
                    'Backhoe quick coupler' => 'Manual',
                    'Backhoe thumb' => 'Hydraulic',
                    'Backhoe auxiliary hydraulics' => 'Yes',
                    'Backhoe bucket' => 'Caterpillar, 24" width, 5 teeth',
                    'Front tires' => '12.5/80-18',
                    'Rear tires' => '19.5L-24',
                ],
            ],
            [
                'category' => 'Backhoes',
                'brand' => 'Case',
                'name' => '2016 Case 580 Super N Backhoe',
                'slug' => '2016-case-580-super-n-backhoe',
                'sku' => 'DP6317',
                'stock_number' => 'DP6317',
                'serial_number' => 'JJGN58SNEGC732298',
                'price' => 38100,
                'year' => 2016,
                'hours_used' => 1864,
                'horsepower' => 97,
                'engine' => 'FPT F5BFL413B*B 3.4L diesel',
                'transmission' => 'Shuttle shift, 4F / 4R',
                'drive_type' => Product::DRIVE_TYPE_4WD,
                'image_folder' => '002-2016-case-580-super-n-backhoe',
                'is_featured' => true,
                'sort_order' => 2,
                'short_description' => 'Used 2016 Case 580 Super N backhoe with enclosed cab, four wheel drive, extendable stick and pilot controls.',
                'description' => $this->description([
                    'This 2016 Case 580 Super N backhoe is a used diesel backhoe loader with 1,864 hours showing on the meter.',
                    'The machine includes an enclosed cab with heat and AC, pilot backhoe controls, pattern changer, four wheel drive, loader bucket and extendable stick.',
                    'This listing includes reported condition notes. Please contact us to confirm current condition, repairs, availability and final sale terms before purchase.',
                ]),
                'attributes' => [
                    'Meter hours' => '1,864',
                    'Serial number' => 'JJGN58SNEGC732298',
                    'Engine' => 'FPT F5BFL413B*B',
                    'Engine serial' => '000313225',
                    'Displacement' => '3.4L',
                    'Cylinders' => '4',
                    'Power' => '72 kW',
                    'Fuel type' => 'Diesel',
                    'Transmission' => 'Shuttle shift, 4F / 4R',
                    'Drive' => 'Four wheel drive',
                    'Cab' => 'Enclosed cab with AC and heat',
                    'Backhoe controls' => 'Pilot control with pattern changer',
                    'Loader bucket' => '83" width, bolt-on cutting edge',
                    'Backhoe stick' => 'Extendable',
                    'Backhoe quick coupler' => 'Manual',
                    'Backhoe bucket' => '24" width, 5 teeth',
                    'Front tires' => '12-16.5 NHS',
                    'Rear tires' => '19.5L-24',
                    'Included items' => 'Additional teeth included',
                    'Condition notes' => 'Reported warning indicator fault code, exhaust manifold issues, missing bolts and oil leak. Confirm current condition before purchase.',
                ],
            ],
            [
                'category' => 'Wheel Loaders',
                'brand' => 'Komatsu',
                'name' => '2009 Komatsu WA150-6 Wheel Loader',
                'slug' => '2009-komatsu-wa150-6-wheel-loader',
                'sku' => 'DX7266',
                'stock_number' => 'DX7266',
                'serial_number' => 'KMTWA115A01080017',
                'price' => 38900,
                'year' => 2009,
                'hours_used' => 5772,
                'horsepower' => null,
                'engine' => 'Komatsu SAA4D95LE-5-A 3.261L diesel',
                'transmission' => 'Powershift, 4F / 4R',
                'drive_type' => Product::DRIVE_TYPE_4WD,
                'image_folder' => '003-2009-komatsu-wa150-6-wheel-loader',
                'is_featured' => true,
                'sort_order' => 3,
                'short_description' => 'Used 2009 Komatsu WA150-6 wheel loader with enclosed cab, hydraulic quick coupler, grapple and auxiliary hydraulics.',
                'description' => $this->description([
                    'This 2009 Komatsu WA150-6 wheel loader is a used diesel wheel loader with 5,772 hours showing on the meter.',
                    'The loader is equipped with an enclosed cab, heat and AC, joystick bucket controls, front auxiliary hydraulics, hydraulic quick coupler, counter weights and a JRB bucket with GrabTec grapple.',
                    'This listing includes reported condition notes. Please confirm current condition, availability and final terms before purchase.',
                ]),
                'attributes' => [
                    'Meter hours' => '5,772',
                    'Serial number' => 'KMTWA115A01080017',
                    'Unit number' => '51-30',
                    'Engine' => 'Komatsu SAA4D95LE-5-A',
                    'Displacement' => '3.261L',
                    'Cylinders' => '4',
                    'Fuel type' => 'Diesel',
                    'Transmission' => 'Powershift, 4F / 4R',
                    'Cab' => 'Enclosed cab with AC and heat',
                    'Bucket controls' => 'Joystick',
                    'Auxiliary hydraulics' => 'Front',
                    'Quick coupler' => 'Hydraulic',
                    'Counter weights' => 'Yes',
                    'Bucket' => 'JRB WA150-5',
                    'Bucket capacity' => '2 cu. yd.',
                    'Bucket width' => '94"',
                    'Cutting edge' => 'Bolt-on',
                    'Grapple' => 'GrabTec grapple',
                    'Tires' => '17.5R25',
                    'Condition notes' => 'Reported grapple hydraulic cylinder leak. Confirm current condition before purchase.',
                ],
            ],
            [
                'category' => 'Skid Steer Loaders',
                'brand' => 'Bobcat',
                'name' => '2024 Bobcat T770 Tracked Skid Steer Loader',
                'slug' => '2024-bobcat-t770-tracked-skid-steer-loader',
                'sku' => 'EC3701',
                'stock_number' => 'EC3701',
                'serial_number' => 'AT6345753',
                'price' => 43150,
                'year' => 2024,
                'hours_used' => 115,
                'horsepower' => null,
                'engine' => '4-cylinder diesel',
                'transmission' => 'Hydrostatic, two speed travel',
                'drive_type' => null,
                'image_folder' => '004-2024-bobcat-t770-tracked-skid-steer-loader',
                'is_featured' => true,
                'sort_order' => 4,
                'short_description' => 'Used 2024 Bobcat T770 tracked skid steer loader with enclosed cab, hydraulic quick coupler and auxiliary hydraulics.',
                'description' => $this->description([
                    'This 2024 Bobcat T770 tracked skid steer loader is a used diesel compact track loader with 115 hours showing on the meter.',
                    'The machine includes an enclosed cab, heat and AC, hand bucket controls, pattern changer, electronic monitoring system panel, auxiliary hydraulics, auxiliary electrical outlet and hydraulic quick coupler.',
                    'It is equipped with a Bobcat 80 Severe Duty bucket and 18 inch tracks. Please confirm availability, current hours and final condition before purchase.',
                ]),
                'attributes' => [
                    'Meter hours' => '115',
                    'Serial number' => 'AT6345753',
                    'Engine' => '4-cylinder diesel',
                    'Fuel type' => 'Diesel',
                    'Transmission' => 'Hydrostatic',
                    'Travel speed' => 'Two speed travel',
                    'Cab' => 'Enclosed cab with AC and heat',
                    'Bucket control' => 'Hand',
                    'Pattern changer' => 'Yes',
                    'Monitoring panel' => 'Electronic Monitoring System panel',
                    'Auxiliary hydraulics' => 'Yes',
                    'Auxiliary electrical outlet' => 'Yes',
                    'Quick coupler' => 'Hydraulic',
                    'Bucket' => 'Bobcat 80 Severe Duty',
                    'Bucket capacity' => '24.8 cu. yd.',
                    'Bucket width' => '80"',
                    'Bucket teeth' => 'Bolt-on',
                    'Track width' => '18"',
                ],
            ],
            [
                'category' => 'Skid Steer Loaders',
                'brand' => 'John Deere',
                'name' => '2020 John Deere 333G Tracked Skid Steer Loader',
                'slug' => '2020-john-deere-333g-tracked-skid-steer-loader',
                'sku' => 'DY0813',
                'stock_number' => 'DY0813',
                'serial_number' => '1T0333GMALF371924',
                'price' => 41800,
                'year' => 2020,
                'hours_used' => 934,
                'horsepower' => null,
                'engine' => 'Yanmar 4TNV94FHT 3.1L diesel',
                'transmission' => 'Hydrostatic, two speed travel',
                'drive_type' => null,
                'image_folder' => '005-2020-john-deere-333g-tracked-skid-steer-loader',
                'is_featured' => true,
                'sort_order' => 5,
                'short_description' => 'Used 2020 John Deere 333G tracked skid steer loader with enclosed cab, backup camera and hydraulic quick coupler.',
                'description' => $this->description([
                    'This 2020 John Deere 333G tracked skid steer loader is a used diesel compact track loader with 934 hours showing on the meter.',
                    'The unit includes an enclosed cab with heat and AC, backup camera, hand bucket controls, pattern changer, electronic monitoring panel, auxiliary hydraulics, hydraulic quick coupler and counter weights.',
                    'It is fitted with a Bobcat bucket and 17.5 inch tracks. Please confirm current availability, condition, hours and final terms before purchase.',
                ]),
                'attributes' => [
                    'Meter hours' => '934',
                    'Serial number' => '1T0333GMALF371924',
                    'Engine' => 'Yanmar 4TNV94FHT',
                    'Displacement' => '3.1L',
                    'Cylinders' => '4',
                    'Fuel type' => 'Diesel',
                    'Transmission' => 'Hydrostatic',
                    'Travel speed' => 'Two speed travel',
                    'Cab' => 'Enclosed cab with AC and heat',
                    'Backup camera' => 'Yes',
                    'Bucket control' => 'Hand',
                    'Pattern changer' => 'Yes',
                    'Monitoring panel' => 'Electronic Monitoring System panel',
                    'Auxiliary hydraulics' => 'Yes',
                    'Quick coupler' => 'Hydraulic',
                    'Counter weights' => 'Yes',
                    'Bucket' => 'Bobcat, 82" width, bolt-on cutting edge',
                    'Track width' => '17.5"',
                ],
            ],
            [
                'category' => 'Tractors',
                'brand' => 'New Holland',
                'name' => '2022 New Holland T5.110 MFWD Tractor',
                'slug' => '2022-new-holland-t5110-mfwd-tractor',
                'sku' => 'DM1969',
                'stock_number' => 'DM1969',
                'serial_number' => 'HLRT5110JNL108949',
                'price' => 41600,
                'year' => 2022,
                'hours_used' => 1085,
                'horsepower' => 99,
                'engine' => 'New Holland F5LGL413C 3.6L diesel',
                'transmission' => 'Dual power, 24F / 24R, left-hand reverser',
                'drive_type' => Product::DRIVE_TYPE_MFWD,
                'image_folder' => '006-2022-new-holland-t5110-mfwd-tractor',
                'is_featured' => true,
                'sort_order' => 6,
                'short_description' => 'Used 2022 New Holland T5.110 MFWD tractor with loader, joystick controls, three point and hydraulic remotes.',
                'description' => $this->description([
                    'This 2022 New Holland T5.110 MFWD tractor is a used diesel tractor with 1,085 hours showing on the meter.',
                    'The tractor is equipped with a 99 HP New Holland diesel engine, dual power transmission, 24 forward and 24 reverse speeds, left-hand reverser, differential lock, AC and heat, PTO, three point hitch and rear hydraulic remotes.',
                    'It includes a New Holland 720LU loader with joystick controls and 85 inch bucket. Please confirm current condition, availability and final sale terms before purchase.',
                ]),
                'attributes' => [
                    'Meter hours' => '1,085',
                    'Serial number' => 'HLRT5110JNL108949',
                    'Engine' => 'New Holland F5LGL413C',
                    'Displacement' => '3.6L',
                    'Cylinders' => '4',
                    'Horsepower' => '99 HP',
                    'Fuel type' => 'Diesel',
                    'Transmission' => 'Dual power, 24F / 24R',
                    'Reverser' => 'Left-hand reverser',
                    'Drive' => 'MFWD',
                    'Differential lock' => 'Yes',
                    'Operator station' => 'AC and heat',
                    'PTO' => '540 / 1000',
                    'Three point' => 'Yes',
                    'Seven pin outlet' => 'Yes',
                    'Rear hydraulic remotes' => '2',
                    'Loader' => 'New Holland 720LU',
                    'Loader controls' => 'Joystick',
                    'Bucket width' => '85"',
                    'Front tires' => '380/85R24',
                    'Rear tires' => '460/85R34',
                    'Wheel weights' => '4',
                ],
            ],
            [
                'category' => 'Tractors',
                'brand' => 'John Deere',
                'name' => '2013 John Deere 6115D MFWD Tractor',
                'slug' => '2013-john-deere-6115d-mfwd-tractor',
                'sku' => 'EM8372',
                'stock_number' => 'EM8372',
                'serial_number' => '1P06115DKDM051130',
                'price' => 39500,
                'year' => 2013,
                'hours_used' => 1399,
                'horsepower' => null,
                'engine' => 'John Deere 4045HP056 4.5L diesel',
                'transmission' => 'Synchro, 9F / 9R, left-hand reverser',
                'drive_type' => Product::DRIVE_TYPE_MFWD,
                'image_folder' => '007-2013-john-deere-6115d-mfwd-tractor',
                'is_featured' => false,
                'sort_order' => 7,
                'short_description' => 'Used 2013 John Deere 6115D MFWD tractor with John Deere H310 loader, grapple bucket and rear hydraulic remotes.',
                'description' => $this->description([
                    'This 2013 John Deere 6115D MFWD tractor is a used diesel tractor with 1,399 hours showing on the meter.',
                    'The tractor includes a John Deere diesel engine, Synchro transmission, left-hand reverser, differential lock, AC and heat, PTO, three point hitch, rear hydraulic remotes and John Deere H310 loader.',
                    'It is equipped with a grapple bucket and wheel weights. Please confirm current condition, availability and final sale terms before purchase.',
                ]),
                'attributes' => [
                    'Meter hours' => '1,399',
                    'Serial number' => '1P06115DKDM051130',
                    'Engine' => 'John Deere 4045HP056',
                    'Displacement' => '4.5L',
                    'Cylinders' => '6',
                    'Fuel type' => 'Diesel',
                    'Transmission' => 'Synchro, 9F / 9R',
                    'Reverser' => 'Left-hand reverser',
                    'Drive' => 'MFWD',
                    'Differential lock' => 'Yes',
                    'Operator station' => 'AC and heat',
                    'PTO' => '1000',
                    'Three point' => 'Yes',
                    'Seven pin outlet' => 'Yes',
                    'Rear hydraulic remotes' => '3',
                    'Loader' => 'John Deere H310',
                    'Loader controls' => 'Joystick',
                    'Bucket' => 'Grapple bucket, 87" width',
                    'Front tires' => '14.9-24',
                    'Rear tires' => '18.4-38',
                    'Wheel weights' => '8',
                ],
            ],
            [
                'category' => 'Tractors',
                'brand' => 'John Deere',
                'name' => '2014 John Deere 6105M MFWD Tractor',
                'slug' => '2014-john-deere-6105m-mfwd-tractor',
                'sku' => 'DE2168',
                'stock_number' => 'DE2168',
                'serial_number' => '1L06105MKEH791057',
                'price' => 37700,
                'year' => 2014,
                'hours_used' => 2896,
                'horsepower' => null,
                'engine' => 'John Deere 4-cylinder diesel',
                'transmission' => 'Powershift, 16F / 16R, left-hand reverser',
                'drive_type' => Product::DRIVE_TYPE_MFWD,
                'image_folder' => '008-2014-john-deere-6105m-mfwd-tractor',
                'is_featured' => false,
                'sort_order' => 8,
                'short_description' => 'Used 2014 John Deere 6105M MFWD tractor with H340 loader, self-leveling loader, bale spear and rear hydraulic remotes.',
                'description' => $this->description([
                    'This 2014 John Deere 6105M MFWD tractor is a used diesel tractor with 2,896 hours showing on the meter.',
                    'The tractor features a John Deere diesel engine, powershift transmission, 16 forward and 16 reverse speeds, left-hand reverser, differential lock, AC and heat, PTO, three point hitch and rear hydraulic remotes.',
                    'It includes a John Deere H340 loader with quick attach, bale spear, self-leveling function and joystick controls. Please confirm current condition and availability before purchase.',
                ]),
                'attributes' => [
                    'Meter hours' => '2,896',
                    'Serial number' => '1L06105MKEH791057',
                    'Engine' => 'John Deere',
                    'Cylinders' => '4',
                    'Fuel type' => 'Diesel',
                    'Transmission' => 'Powershift, 16F / 16R',
                    'Reverser' => 'Left-hand reverser',
                    'Drive' => 'MFWD',
                    'Differential lock' => 'Yes',
                    'Operator station' => 'AC and heat',
                    'PTO' => '540 / 1000',
                    'Three point' => 'Yes',
                    'Top link' => 'Yes',
                    'Seven pin outlet' => 'Yes',
                    'Rear hydraulic remotes' => '3',
                    'Loader' => 'John Deere H340',
                    'Loader quick attach' => 'Yes',
                    'Bale spear' => 'Yes',
                    'Self-leveling loader' => 'Yes',
                    'Loader controls' => 'Joystick',
                    'Front tires' => '380/85R24',
                    'Rear tires' => '460/85R34',
                ],
            ],
            [
                'category' => 'Tractors',
                'brand' => 'John Deere',
                'name' => '2004 John Deere 5520 MFWD Tractor',
                'slug' => '2004-john-deere-5520-mfwd-tractor',
                'sku' => 'DU9804',
                'stock_number' => 'DU9804',
                'serial_number' => 'LV5520S453304',
                'price' => 21900,
                'year' => 2004,
                'hours_used' => 498,
                'horsepower' => null,
                'engine' => 'John Deere 4.5L diesel',
                'transmission' => 'Synchro, 9F / 3R',
                'drive_type' => Product::DRIVE_TYPE_MFWD,
                'image_folder' => '009-2004-john-deere-5520-mfwd-tractor',
                'is_featured' => false,
                'sort_order' => 9,
                'short_description' => 'Used 2004 John Deere 5520 MFWD tractor with John Deere 542 loader, joystick controls and rear hydraulic remotes.',
                'description' => $this->description([
                    'This 2004 John Deere 5520 MFWD tractor is a used diesel tractor with 498 hours showing on the meter.',
                    'The tractor includes a John Deere diesel engine, Synchro transmission, differential lock, AC and heat, PTO, three point hitch, rear hydraulic remotes and John Deere 542 loader.',
                    'The listing notes that the dash was replaced and actual hours are unknown. Please confirm current condition, hours and availability before purchase.',
                ]),
                'attributes' => [
                    'Meter hours' => '498',
                    'Actual hours' => 'Unknown',
                    'Serial number' => 'LV5520S453304',
                    'Engine' => 'John Deere',
                    'Displacement' => '4.5L',
                    'Cylinders' => '4',
                    'Fuel type' => 'Diesel',
                    'Transmission' => 'Synchro, 9F / 3R',
                    'Drive' => 'MFWD',
                    'Differential lock' => 'Yes',
                    'Operator station' => 'AC and heat',
                    'PTO' => '540',
                    'Three point' => 'Yes',
                    'Seven pin outlet' => 'Yes',
                    'Rear hydraulic remotes' => '2',
                    'Loader' => 'John Deere 542',
                    'Loader quick attach' => 'Yes',
                    'Loader controls' => 'Joystick',
                    'Bucket width' => '75"',
                    'Front tires' => '11.2-24',
                    'Rear tires' => '16.9R30',
                    'Wheel weights' => '2',
                    'Condition notes' => 'Dash replaced. Rotary mower not included.',
                ],
            ],
            [
                'category' => 'Tractors',
                'brand' => 'Case',
                'name' => '2016 Case Farmall 75C MFWD Tractor',
                'slug' => '2016-case-farmall-75c-mfwd-tractor',
                'sku' => 'DX8987',
                'stock_number' => 'DX8987',
                'serial_number' => 'ZGAL50447',
                'price' => 24650,
                'year' => 2016,
                'hours_used' => 882,
                'horsepower' => null,
                'engine' => '3.2L diesel',
                'transmission' => 'Powershift, 12F / 12R, left-hand reverser',
                'drive_type' => Product::DRIVE_TYPE_MFWD,
                'image_folder' => '010-2016-case-farmall-75c-mfwd-tractor',
                'is_featured' => false,
                'sort_order' => 10,
                'short_description' => 'Used 2016 Case Farmall 75C MFWD tractor with Case L620 loader, quick attach bucket and rear hydraulic remotes.',
                'description' => $this->description([
                    'This 2016 Case Farmall 75C MFWD tractor is a used diesel tractor with 882 hours showing on the meter.',
                    'The tractor includes a 3.2L diesel engine, powershift transmission, 12 forward and 12 reverse speeds, left-hand reverser, differential lock, AC and heat, PTO, three point hitch and rear hydraulic remotes.',
                    'It is equipped with a Case L620 loader, quick attach, joystick controls and 84 inch bucket. Please confirm current condition, availability and final sale terms before purchase.',
                ]),
                'attributes' => [
                    'Meter hours' => '882',
                    'Serial number' => 'ZGAL50447',
                    'Engine displacement' => '3.2L',
                    'Cylinders' => '4',
                    'Fuel type' => 'Diesel',
                    'Transmission' => 'Powershift, 12F / 12R',
                    'Reverser' => 'Left-hand reverser',
                    'Drive' => 'MFWD',
                    'Differential lock' => 'Yes',
                    'Operator station' => 'AC and heat',
                    'PTO' => '540',
                    'Three point' => 'Yes',
                    'Top link' => 'Yes',
                    'Seven pin outlet' => 'Yes',
                    'Rear hydraulic remotes' => '2',
                    'Loader' => 'Case L620',
                    'Loader quick attach' => 'Yes',
                    'Loader controls' => 'Joystick',
                    'Bucket width' => '84"',
                    'Front tires' => '280/85R24',
                    'Rear tires' => '420/85R30',
                    'Wheel weights' => '4',
                ],
            ],
        ];
    }

    /**
     * @param  array<int, string>  $paragraphs
     */
    private function description(array $paragraphs): string
    {
        return collect($paragraphs)
            ->map(static fn (string $paragraph): string => '<p>'.e($paragraph).'</p>')
            ->implode('');
    }

    private function mainImagePath(string $folder): string
    {
        return sprintf('products/%s/001.webp', $folder);
    }

    private function createImages(Product $product, string $folder): void
    {
        $folderPath = storage_path(sprintf('app/public/products/%s', $folder));

        if (! File::isDirectory($folderPath)) {
            return;
        }

        $files = collect(File::files($folderPath))
            ->filter(static fn ($file): bool => $file->getExtension() === 'webp')
            ->reject(static fn ($file): bool => str_starts_with($file->getFilename(), 'thumb_'))
            ->sortBy(static fn ($file): string => $file->getFilename())
            ->values();

        foreach ($files as $index => $file) {
            $filename = $file->getFilename();

            $imagePath = sprintf('products/%s/%s', $folder, $filename);
            $thumbnailPath = sprintf('products/%s/thumb_%s', $folder, $filename);

            ProductImage::query()->create([
                'product_id' => $product->id,
                'path' => $imagePath,
                'thumbnail_path' => File::exists(storage_path('app/public/'.$thumbnailPath)) ? $thumbnailPath : null,
                'alt' => $product->name,
                'sort_order' => $index + 1,
            ]);
        }
    }

    /**
     * @param  array<string, string>  $attributes
     */
    private function createAttributes(Product $product, array $attributes): void
    {
        $sortOrder = 1;

        foreach ($attributes as $name => $value) {
            ProductAttribute::query()->create([
                'product_id' => $product->id,
                'name' => $name,
                'value' => $value,
                'sort_order' => $sortOrder,
            ]);

            $sortOrder++;
        }
    }
}
