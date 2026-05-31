<?php

declare(strict_types=1);

namespace App\Services\Lead;

use App\Models\Lead;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final readonly class ProductLeadService
{
    public function __construct(
        private LeadNotificationService $leadNotificationService,
    ) {
    }

    /**
     * @param array{
     *     name:string,
     *     phone:string,
     *     email?:string|null,
     *     message?:string|null,
     *     zip_code:string,
     *     consent_accepted:bool|string|int,
     *     preferred_contact_method?:string|null
     * } $data
     * @param array{
     *     source_page?:string|null,
     *     ip_address?:string|null,
     *     user_agent?:string|null,
     *     utm_source?:string|null,
     *     utm_medium?:string|null,
     *     utm_campaign?:string|null,
     *     utm_content?:string|null,
     *     utm_term?:string|null,
     *     fbp?:string|null,
     *     fbc?:string|null
     * } $context
     * @throws \Throwable
     */
    public function createFromProduct(Product $product, array $data, array $context = []): Lead
    {
        return DB::transaction(function () use ($product, $data, $context): Lead {
            /** @var Lead $lead */
            $lead = Lead::query()->create([
                'type' => Lead::TYPE_QUOTE,
                'name' => $data['name'],
                'email' => $data['email'] ?? null,
                'phone' => $data['phone'],
                'zip_code' => $data['zip_code'],
                'consent_accepted' => (bool) ($data['consent_accepted'] ?? false),
                'preferred_contact_method' => $data['preferred_contact_method'] ?? Lead::PREFERRED_CONTACT_ANY,
                'subject' => sprintf('Quote request: %s', $product->name),
                'message' => $data['message'] ?? null,
                'status' => Lead::STATUS_NEW,
                'source' => 'product_page',
                'source_page' => $context['source_page'] ?? null,
                'utm_source' => $context['utm_source'] ?? null,
                'utm_medium' => $context['utm_medium'] ?? null,
                'utm_campaign' => $context['utm_campaign'] ?? null,
                'utm_content' => $context['utm_content'] ?? null,
                'utm_term' => $context['utm_term'] ?? null,
                'fbp' => $context['fbp'] ?? null,
                'fbc' => $context['fbc'] ?? null,
                'ip_address' => $context['ip_address'] ?? null,
                'user_agent' => $context['user_agent'] ?? null,
            ]);

            $lead->items()->create([
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
            ]);

            $this->leadNotificationService->sendNewLeadNotification($lead);

            return $lead;
        });
    }

    /**
     * @param Collection<int, array{product: Product, quantity: int}> $items
     * @param array{
     *     name:string,
     *     phone:string,
     *     email?:string|null,
     *     message?:string|null,
     *     zip_code:string,
     *     consent_accepted:bool|string|int,
     *     preferred_contact_method?:string|null
     * } $data
     * @param array{
     *     source_page?:string|null,
     *     ip_address?:string|null,
     *     user_agent?:string|null,
     *     utm_source?:string|null,
     *     utm_medium?:string|null,
     *     utm_campaign?:string|null,
     *     utm_content?:string|null,
     *     utm_term?:string|null,
     *     fbp?:string|null,
     *     fbc?:string|null
     * } $context
     * @throws \Throwable
     */
    public function createFromQuoteCart(Collection $items, array $data, array $context = []): Lead
    {
        return DB::transaction(function () use ($items, $data, $context): Lead {
            /** @var Lead $lead */
            $lead = Lead::query()->create([
                'type' => Lead::TYPE_QUOTE,
                'name' => $data['name'],
                'email' => $data['email'] ?? null,
                'phone' => $data['phone'],
                'zip_code' => $data['zip_code'],
                'consent_accepted' => (bool) ($data['consent_accepted'] ?? false),
                'preferred_contact_method' => $data['preferred_contact_method'] ?? Lead::PREFERRED_CONTACT_ANY,
                'subject' => 'Quote request',
                'message' => $data['message'] ?? null,
                'status' => Lead::STATUS_NEW,
                'source' => 'quote_cart',
                'source_page' => $context['source_page'] ?? null,
                'utm_source' => $context['utm_source'] ?? null,
                'utm_medium' => $context['utm_medium'] ?? null,
                'utm_campaign' => $context['utm_campaign'] ?? null,
                'utm_content' => $context['utm_content'] ?? null,
                'utm_term' => $context['utm_term'] ?? null,
                'fbp' => $context['fbp'] ?? null,
                'fbc' => $context['fbc'] ?? null,
                'ip_address' => $context['ip_address'] ?? null,
                'user_agent' => $context['user_agent'] ?? null,
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

            $this->leadNotificationService->sendNewLeadNotification($lead);

            return $lead;
        });
    }
}
