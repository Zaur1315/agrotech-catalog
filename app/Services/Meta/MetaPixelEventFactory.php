<?php

declare(strict_types=1);

namespace App\Services\Meta;

use App\Models\Product;

final readonly class MetaPixelEventFactory
{
    private const EVENT_LEAD = 'Lead';

    private const EVENT_VIEW_CONTENT = 'ViewContent';

    public function __construct(
        private MetaEventIdFactory $eventIdFactory,
    ) {}

    /**
     * @return array{name:string, event_id:string}
     */
    public function makeLead(): array
    {
        return [
            'name' => self::EVENT_LEAD,
            'event_id' => $this->eventIdFactory->make(self::EVENT_LEAD),
        ];
    }

    /**
     * @return array{
     *     name:string,
     *     event_id:string,
     *     content_ids:array<int, string>,
     *     content_type:string,
     *     content_category:string|null,
     *     content_name:string,
     *     value:float|null,
     *     currency:string
     * }
     */
    public function makeViewContent(Product $product): array
    {
        return [
            'name' => self::EVENT_VIEW_CONTENT,
            'event_id' => $this->eventIdFactory->make(self::EVENT_VIEW_CONTENT),
            'content_ids' => [ (string) ($product->stock_number ?? $product->sku ?? $product->id)],
            'content_type' => 'product',
            'content_category' => $product->category?->name,
            'content_name' => $product->name,
            'value' => $product->price !== null ? (float) $product->price : null,
            'currency' => 'USD',
        ];
    }
}
