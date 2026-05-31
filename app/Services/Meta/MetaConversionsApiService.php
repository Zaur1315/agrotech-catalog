<?php

declare(strict_types=1);

namespace App\Services\Meta;

use App\Models\Lead;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

final readonly class MetaConversionsApiService
{
    private const EVENT_LEAD = 'Lead';

    private const ACTION_SOURCE_WEBSITE = 'website';

    public function sendLead(Lead $lead, string $eventId): void
    {
        if (! $this->isEnabled()) {
            return;
        }

        $lead->loadMissing('items.product');

        $payload = [
            'data' => [
                [
                    'event_name' => self::EVENT_LEAD,
                    'event_time' => now()->timestamp,
                    'event_id' => $eventId,
                    'action_source' => self::ACTION_SOURCE_WEBSITE,
                    'event_source_url' => $lead->source_page,
                    'user_data' => $this->buildUserData($lead),
                    'custom_data' => $this->buildCustomData($lead),
                ],
            ],
        ];

        $testEventCode = config('services.meta.capi_test_event_code');

        if (! empty($testEventCode)) {
            $payload['test_event_code'] = $testEventCode;
        }

        $this->debugPayload($lead, $eventId, $payload);

        try {
            $response = Http::timeout(5)
                ->acceptJson()
                ->post($this->endpoint(), $payload);

            $response->throw();

            $this->debugResponse($lead, $eventId, $response->json());

        } catch (RequestException $exception) {
            Log::warning('Meta CAPI Lead event failed.', [
                'lead_id' => $lead->id,
                'event_id' => $eventId,
                'status' => $exception->response?->status(),
                'response' => $exception->response?->json(),
            ]);
        } catch (\Throwable $exception) {
            Log::warning('Meta CAPI Lead event failed.', [
                'lead_id' => $lead->id,
                'event_id' => $eventId,
                'message' => $exception->getMessage(),
            ]);
        }
    }

    private function isEnabled(): bool
    {
        return (bool) config('services.meta.capi_enabled')
            && ! empty(config('services.meta.pixel_id'))
            && ! empty(config('services.meta.capi_access_token'));
    }

    private function endpoint(): string
    {
        $version = config('services.meta.graph_api_version', 'v25.0');
        $pixelId = config('services.meta.pixel_id');
        $accessToken = config('services.meta.capi_access_token');

        return sprintf(
            'https://graph.facebook.com/%s/%s/events?access_token=%s',
            $version,
            $pixelId,
            urlencode((string) $accessToken),
        );
    }

    private function buildUserData(Lead $lead): array
    {
        [$firstName, $lastName] = $this->splitName($lead->name);

        return array_filter([
            'client_ip_address' => $lead->ip_address,
            'client_user_agent' => $lead->user_agent,
            'fbp' => $lead->fbp,
            'fbc' => $lead->fbc,
            'em' => $this->hashNullableValue($lead->email),
            'ph' => $this->hashNullableValue($this->normalizeUsPhone($lead->phone)),
            'fn' => $this->hashNullableValue($firstName),
            'ln' => $this->hashNullableValue($lastName),
            'external_id' => $this->hashNullableValue((string) $lead->id),
            'zp' => $this->hashNullableValue($lead->zip_code),
        ]);
    }

    private function buildCustomData(Lead $lead): array
    {
        $items = $lead->items;

        $contentIds = $items
            ->map(static fn ($item): ?string => $item->product?->stock_number
                ?? $item->product?->sku
                ?? ($item->product_id !== null ? (string) $item->product_id : null))
            ->filter()
            ->values()
            ->all();

        $contentNames = $items
            ->pluck('product_name')
            ->filter()
            ->values()
            ->all();

        $value = $items
            ->sum(static fn ($item): float => (float) ($item->price ?? 0) * (int) $item->quantity);

        return array_filter([
            'lead_type' => $lead->type,
            'preferred_contact_method' => $lead->preferred_contact_method,
            'source_page' => $lead->source_page,
            'content_ids' => $contentIds !== [] ? $contentIds : null,
            'content_name' => $contentNames !== [] ? implode(', ', $contentNames) : null,
            'content_type' => $contentIds !== [] ? 'product' : null,
            'currency' => $contentIds !== [] ? 'USD' : null,
            'value' => $value > 0 ? $value : null,
        ]);
    }

    private function hashNullableValue(?string $value): ?string
    {
        if ($value === null || trim($value) === '') {
            return null;
        }

        return hash('sha256', mb_strtolower(trim($value)));
    }

    private function normalizeUsPhone(?string $phone): ?string
    {
        if ($phone === null) {
            return null;
        }

        $digits = preg_replace('/\D+/', '', $phone);

        if ($digits === null || $digits === '') {
            return null;
        }

        if (strlen($digits) === 10) {
            return '1'.$digits;
        }

        return $digits;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    private function debugPayload(Lead $lead, string $eventId, array $payload): void
    {
        if (! config('services.meta.capi_debug')) {
            return;
        }

        Log::info('Meta CAPI Lead event payload prepared.', [
            'lead_id' => $lead->id,
            'event_id' => $eventId,
            'pixel_id' => config('services.meta.pixel_id'),
            'graph_api_version' => config('services.meta.graph_api_version'),
            'payload' => $payload,
        ]);
    }

    /**
     * @param  array<string, mixed>|null  $response
     */
    private function debugResponse(Lead $lead, string $eventId, ?array $response): void
    {
        if (! config('services.meta.capi_debug')) {
            return;
        }

        Log::info('Meta CAPI Lead event sent successfully.', [
            'lead_id' => $lead->id,
            'event_id' => $eventId,
            'response' => $response,
        ]);
    }

    /**
     * @return array{0: string|null, 1: string|null}
     */
    private function splitName(?string $name): array
    {
        if ($name === null || trim($name) === '') {
            return [null, null];
        }

        $parts = preg_split('/\s+/', trim($name));

        if ($parts === false || $parts === []) {
            return [null, null];
        }

        $firstName = $parts[0] ?? null;
        $lastName = count($parts) > 1 ? $parts[count($parts) - 1] : null;

        return [$firstName, $lastName];
    }
}
