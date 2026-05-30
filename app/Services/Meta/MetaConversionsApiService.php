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
        return array_filter([
            'client_ip_address' => $lead->ip_address,
            'client_user_agent' => $lead->user_agent,
            'fbp' => $lead->fbp,
            'fbc' => $lead->fbc,
            'em' => $this->hashNullableValue($lead->email),
            'ph' => $this->hashNullableValue($this->normalizePhone($lead->phone)),
        ]);
    }

    private function buildCustomData(Lead $lead): array
    {
        return array_filter([
            'lead_type' => $lead->type,
            'preferred_contact_method' => $lead->preferred_contact_method,
            'source_page' => $lead->source_page,
        ]);
    }

    private function hashNullableValue(?string $value): ?string
    {
        if ($value === null || trim($value) === '') {
            return null;
        }

        return hash('sha256', mb_strtolower(trim($value)));
    }

    private function normalizePhone(?string $phone): ?string
    {
        if ($phone === null) {
            return null;
        }

        $normalized = preg_replace('/\D+/', '', $phone);

        return $normalized !== '' ? $normalized : null;
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
     * @param array<string, mixed>|null $response
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
}
