@props([
    'class' => '',
    'label' => null,
])

<a
    href="{{ config('site.maps_url') }}"
    target="_blank"
    rel="noopener"
    class="{{ $class }}"
>
    {{ $label ?? config('site.address') }}
</a>
