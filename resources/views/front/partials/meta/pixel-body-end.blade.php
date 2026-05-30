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
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof fbq !== 'function') {
                return;
            }

            document.querySelectorAll('a[href^="tel:"], a[href^="mailto:"]').forEach(function (link) {
                link.addEventListener('click', function () {
                    fbq('trackCustom', 'ContactClick', {
                        contact_type: link.href.startsWith('tel:') ? 'phone' : 'email'
                    });
                });
            });
        });
    </script>
@endif
