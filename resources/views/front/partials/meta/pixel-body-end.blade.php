@if (config('services.meta.pixel_enabled') && config('services.meta.pixel_id') && session()->has('meta_event'))
    @php
        $metaEvent = session('meta_event');
        $metaEventName = is_array($metaEvent) ? ($metaEvent['name'] ?? null) : null;
        $metaEventId = is_array($metaEvent) ? ($metaEvent['event_id'] ?? null) : null;
        $metaEventPayload = is_array($metaEvent) ? ($metaEvent['payload'] ?? []) : [];
    @endphp

    @if ($metaEventName === 'Lead')
        <script>
            if (typeof fbq === 'function') {
                console.info('[Meta Pixel] Sending Lead event', {
                    eventID: @json($metaEventId),
                    payload: @json($metaEventPayload),
                    url: window.location.href
                });

                fbq('track', 'Lead', @json($metaEventPayload), {
                    eventID: @json($metaEventId)
                });
            } else {
                console.warn('[Meta Pixel] Lead event was not sent because fbq is not available', {
                    eventID: @json($metaEventId),
                    url: window.location.href
                });
            }
        </script>
    @endif
@endif

@stack('meta_pixel_events')
