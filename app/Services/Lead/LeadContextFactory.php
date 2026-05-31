<?php

declare(strict_types=1);

namespace App\Services\Lead;

use Illuminate\Http\Request;

final readonly class LeadContextFactory
{
    private const MAX_TRACKING_VALUE_LENGTH = 255;

    private const MAX_SOURCE_PAGE_LENGTH = 1000;

    private const MAX_USER_AGENT_LENGTH = 1000;

    /**
     * @return array{
     *     source_page:string,
     *     ip_address:?string,
     *     user_agent:?string,
     *     utm_source:?string,
     *     utm_medium:?string,
     *     utm_campaign:?string,
     *     utm_content:?string,
     *     utm_term:?string,
     *     fbp:?string,
     *     fbc:?string
     * }
     */
    public function fromRequest(Request $request): array
    {
        $sourcePage = $this->resolveSourcePage($request);
        $refererQuery = $this->parseQueryFromUrl($sourcePage);

        return [
            'source_page' => $this->limitString($sourcePage, self::MAX_SOURCE_PAGE_LENGTH),
            'ip_address' => $request->ip(),
            'user_agent' => $this->limitNullableString($request->userAgent()),
            'utm_source' => $this->resolveTrackingValue($request, $refererQuery, 'utm_source'),
            'utm_medium' => $this->resolveTrackingValue($request, $refererQuery, 'utm_medium'),
            'utm_campaign' => $this->resolveTrackingValue($request, $refererQuery, 'utm_campaign'),
            'utm_content' => $this->resolveTrackingValue($request, $refererQuery, 'utm_content'),
            'utm_term' => $this->resolveTrackingValue($request, $refererQuery, 'utm_term'),
            'fbp' => $this->resolveBrowserId($request),
            'fbc' => $this->resolveFbc($request, $refererQuery),
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

        if (! is_string($query) || $query === '') {
            return [];
        }

        parse_str($query, $params);

        return array_filter(
            $params,
            static fn (mixed $value): bool => is_string($value),
        );
    }

    /**
     * @param  array<string, string>  $refererQuery
     */
    private function resolveTrackingValue(Request $request, array $refererQuery, string $key): ?string
    {
        $value = $request->input($key)
            ?? $request->query($key)
            ?? $refererQuery[$key]
            ?? null;

        if (! is_string($value) || $value === '') {
            return null;
        }

        return $this->limitString($value, self::MAX_TRACKING_VALUE_LENGTH);
    }

    private function resolveCookieValue(Request $request, string $key): ?string
    {
        $value = $request->cookie($key);

        if (! is_string($value) || $value === '') {
            return null;
        }

        return $this->limitString($value, self::MAX_TRACKING_VALUE_LENGTH);
    }

    private function limitNullableString(?string $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        return $this->limitString($value, self::MAX_USER_AGENT_LENGTH);
    }

    private function limitString(string $value, int $length): string
    {
        return mb_substr($value, 0, $length);
    }

    private function resolveBrowserId(Request $request): ?string
    {
        $value = $request->input('fbp');

        if (is_string($value) && $value !== '') {
            return $this->limitString($value, self::MAX_TRACKING_VALUE_LENGTH);
        }

        return $this->resolveCookieValue($request, '_fbp');
    }

    /**
     * @param  array<string, string>  $refererQuery
     */
    private function resolveFbc(Request $request, array $refererQuery): ?string
    {
        $value = $request->input('fbc');

        if (is_string($value) && $value !== '') {
            return $this->limitString($value, self::MAX_TRACKING_VALUE_LENGTH);
        }

        $cookieValue = $this->resolveCookieValue($request, '_fbc');

        if ($cookieValue !== null) {
            return $cookieValue;
        }

        $fbclid = $request->query('fbclid')
            ?? $refererQuery['fbclid']
            ?? null;

        if (! is_string($fbclid) || $fbclid === '') {
            return null;
        }

        return $this->limitString(
            sprintf('fb.1.%d.%s', time(), $fbclid),
            self::MAX_TRACKING_VALUE_LENGTH,
        );
    }
}
