@if (config('services.meta.pixel_enabled') && config('services.meta.pixel_id'))
    @php
        $metaEvent = session('meta_event');
    @endphp

    @if (is_array($metaEvent) && ($metaEvent['name'] ?? null) === 'Lead')
        <script>
            if (typeof fbq === 'function') {
                fbq('track', 'Lead', {}, {
                    eventID: @json($metaEvent['event_id'] ?? null)
                });
            }
        </script>
    @endif

    <script>
        if (typeof fbq === 'function') {
            const leadName = @json($metaEvent['customer_name'] ?? '');
            const nameParts = typeof leadName === 'string' ? leadName.trim().split(/\s+/) : [];

            fbq('track', 'Lead', {}, {
                eventID: @json($metaEvent['event_id'] ?? null),
                em: @json($metaEvent['email'] ?? null),
                ph: @json(isset($metaEvent['phone']) ? preg_replace('/\D+/', '', $metaEvent['phone']) : null),
                fn: nameParts[0] ? nameParts[0].toLowerCase() : null,
                ln: nameParts.length > 1 ? nameParts[nameParts.length - 1].toLowerCase() : null,
                fbp: @json($metaEvent['fbp'] ?? null),
                fbc: @json($metaEvent['fbc'] ?? null)
            });
        }
    </script>
@endif
