<?php

declare(strict_types=1);

namespace App\Services\Lead;

use Illuminate\Http\Request;

final readonly class LeadContextFactory
{
    /**
     * @return array{
     *     source_page:string,
     *     ip_address:?string,
     *     user_agent:?string,
     *     utm_source:?string,
     *     utm_medium:?string,
     *     utm_campaign:?string,
     *     utm_content:?string,
     *     utm_term:?string
     * }
     */
    public function fromRequest(Request $request): array
    {
        $sourcePage = $this->resolveSourcePage($request);
        $refererQuery = $this->parseQueryFromUrl($sourcePage);

        return [
            'source_page' => $sourcePage,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'utm_source' => $this->resolveTrackingValue($request, $refererQuery, 'utm_source'),
            'utm_medium' => $this->resolveTrackingValue($request, $refererQuery, 'utm_medium'),
            'utm_campaign' => $this->resolveTrackingValue($request, $refererQuery, 'utm_campaign'),
            'utm_content' => $this->resolveTrackingValue($request, $refererQuery, 'utm_content'),
            'utm_term' => $this->resolveTrackingValue($request, $refererQuery, 'utm_term'),
        ];
    }

    private function resolveSourcePage(Request $request): string
    {
        $referer = $request->headers->get('referer');

        if (is_string($referer) && $referer !== '') {
            return $referer;
        }

        return $request->fullUrl();
    }

    /**
     * @return array<string, string>
     */
    private function parseQueryFromUrl(string $url): array
    {
        $query = parse_url($url, PHP_URL_QUERY);

        if (!is_string($query) || $query === '') {
            return [];
        }

        parse_str($query, $params);

        return array_filter(
            $params,
            static fn(mixed $value): bool => is_string($value),
        );
    }

    /**
     * @param array<string, string> $refererQuery
     */
    private function resolveTrackingValue(Request $request, array $refererQuery, string $key): ?string
    {
        $value = $request->input($key)
            ?? $request->query($key)
            ?? $refererQuery[$key]
            ?? null;

        if (!is_string($value) || $value === '') {
            return null;
        }

        return $value;
    }
}
