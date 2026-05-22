<?php

declare(strict_types=1);

namespace App\Services\Lead;

use App\Models\Lead;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final readonly class ProductLeadService
{
    /**
     * @param array{name:string, phone:string, email?:string|null, message?:string|null} $data
     */
    public function createFromProduct(Product $product, array $data): Lead
    {
        return DB::transaction(static function () use ($product, $data): Lead {
            /** @var Lead $lead */
            $lead = Lead::query()->create([
                'name' => $data['name'],
                'email' => $data['email'] ?? null,
                'phone' => $data['phone'],
                'subject' => sprintf('Quote request: %s', $product->name),
                'message' => $data['message'] ?? null,
                'status' => Lead::STATUS_NEW,
                'source' => 'product_page',
            ]);

            $lead->items()->create([
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
            ]);

            return $lead;
        });
    }

    /**
     * @param Collection<int, array{product: Product, quantity: int}> $items
     * @param array{name:string, phone:string, email?:string|null, message?:string|null} $data
     */
    public function createFromQuoteCart(Collection $items, array $data): Lead
    {
        return DB::transaction(static function () use ($items, $data): Lead {
            /** @var Lead $lead */
            $lead = Lead::query()->create([
                'name' => $data['name'],
                'email' => $data['email'] ?? null,
                'phone' => $data['phone'],
                'subject' => 'Quote request',
                'message' => $data['message'] ?? null,
                'status' => Lead::STATUS_NEW,
                'source' => 'quote_cart',
            ]);

            foreach ($items as $item) {
                /** @var Product $product */
                $product = $item['product'];

                $lead->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ]);
            }

            return $lead;
        });
    }
}
