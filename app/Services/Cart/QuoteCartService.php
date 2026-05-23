<?php

declare(strict_types=1);

namespace App\Services\Cart;

use App\Models\Product;
use Illuminate\Support\Collection;

final class QuoteCartService
{
    private const SESSION_KEY = 'quote_cart';

    public function add(Product $product, int $quantity = 1): void
    {
        $items = $this->getRawItems();

        $productId = (string)$product->id;

        if (isset($items[$productId])) {
            $items[$productId]['quantity'] += $quantity;
        } else {
            $items[$productId] = [
                'product_id' => $product->id,
                'quantity' => $quantity,
            ];
        }

        session()->put(self::SESSION_KEY, $items);
    }

    public function remove(int $productId): void
    {
        $items = $this->getRawItems();

        unset($items[(string)$productId]);

        session()->put(self::SESSION_KEY, $items);
    }

    public function clear(): void
    {
        session()->forget(self::SESSION_KEY);
    }

    public function count(): int
    {
        return array_sum(
            array_column($this->getRawItems(), 'quantity')
        );
    }

    /**
     * @return Collection<int, array{product: Product, quantity: int}>
     */
    public function items(): Collection
    {
        $items = $this->getRawItems();

        if ($items === []) {
            return collect();
        }

        $productIds = array_map('intval', array_keys($items));

        return Product::query()
            ->with(['category', 'brand'])
            ->whereIn('id', $productIds)
            ->where('is_active', true)
            ->get()
            ->map(static function (Product $product) use ($items): array {
                $quantity = (int)($items[(string)$product->id]['quantity'] ?? 1);

                return [
                    'product' => $product,
                    'quantity' => $quantity,
                ];
            });
    }

    /**
     * @return array<string, array{product_id: int, quantity: int}>
     */
    private function getRawItems(): array
    {
        return session()->get(self::SESSION_KEY, []);
    }
}
