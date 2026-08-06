@php
    use App\Services\Cart\QuoteCartService;

    $quoteCount = app(QuoteCartService::class)->count();
    $navigation = config('site.navigation', []);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' | ' . config('site.name') : config('site.name') }}</title>
    @stack('seo')
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/site.webmanifest') }}">
    @include('front.partials.meta.pixel-head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen">
<header x-data="{ open: false }" @keydown.escape.window="open = false" class="site-header">
    <div class="site-topbar">
        <div class="site-container site-topbar__inner">
            <span class="site-topbar__notice">{{ config('site.content.header_notice') }}</span>
            <div class="site-topbar__links">
                <a href="tel:{{ config('site.contact.phone_tel') }}" aria-label="Call {{ config('site.contact.phone') }}">
                    <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M6.6 3.5 9 3l2 5-2.1 1.7a15 15 0 0 0 5.4 5.4L16 13l5 2-.5 2.4a2 2 0 0 1-2.2 1.5C10.9 17.8 6.2 13.1 5.1 5.7A2 2 0 0 1 6.6 3.5Z"/></svg>
                    <span>{{ config('site.contact.phone') }}</span>
                </a>
                <a class="hidden md:inline-flex" href="mailto:{{ config('site.contact.email') }}">
                    <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M3.5 6.5h17v11h-17zM4 7l8 6 8-6"/></svg>
                    <span>{{ config('site.contact.email') }}</span>
                </a>
                <a class="hidden sm:inline-flex" href="{{ config('site.contact.maps_url') }}" target="_blank" rel="noopener">
                    Get Directions <span aria-hidden="true">↗</span>
                </a>
            </div>
        </div>
    </div>

    <div class="site-mainbar">
        <div class="site-container site-mainbar__inner">
            <a href="{{ route('home') }}" class="site-logo" aria-label="{{ config('site.name') }} home">
                <span class="site-logo__mark"><img src="{{ asset('/images/brand/moores-farm-equipment.png') }}" alt=""></span>
                <span><strong>Moore's</strong><small>Farm Equipment</small></span>
            </a>

            <nav class="site-nav" aria-label="Primary navigation">
                @foreach($navigation as $item)
                    <a href="{{ route($item['route']) }}" @class(['is-active' => request()->routeIs($item['active'] ?? $item['route'])])>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="site-mainbar__actions">
                <a href="{{ route('catalog.index') }}" class="btn-primary hidden sm:inline-flex">{{ config('site.content.primary_cta_label') }}</a>
                <button type="button" class="menu-toggle" @click="open = !open" :aria-expanded="open.toString()" aria-controls="mobile-navigation">
                    <span class="sr-only" x-text="open ? 'Close menu' : 'Open menu'"></span>
                    <svg x-show="!open" aria-hidden="true" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-cloak x-show="open" aria-hidden="true" viewBox="0 0 24 24"><path d="m6 6 12 12M18 6 6 18"/></svg>
                </button>
            </div>
        </div>

        <div id="mobile-navigation" x-cloak x-show="open" x-transition class="mobile-nav">
            <nav class="site-container" aria-label="Mobile navigation">
                @foreach($navigation as $item)
                    <a href="{{ route($item['route']) }}" @click="open = false" @class(['is-active' => request()->routeIs($item['active'] ?? $item['route'])])>{{ $item['label'] }}</a>
                @endforeach
                <a href="{{ route('catalog.index') }}" class="btn-primary" @click="open = false">{{ config('site.content.primary_cta_label') }}</a>
                <a href="tel:{{ config('site.contact.phone_tel') }}" class="mobile-nav__phone" @click="open = false">Call {{ config('site.contact.phone') }}</a>
            </nav>
        </div>
    </div>
</header>

<main>@yield('content')</main>

<footer class="site-footer">
    <div class="site-container site-footer__grid">
        <section>
            <p class="site-footer__eyebrow">Company</p>
            <div class="site-footer__brand">{{ config('site.name') }}</div>
            <p class="site-footer__description">{{ config('site.content.footer_description') }}</p>
            <p class="site-footer__location">{{ config('site.contact.city') }}, {{ config('site.contact.state') }}</p>
        </section>
        <section>
            <p class="site-footer__eyebrow">Inventory</p>
            <a href="{{ route('catalog.index') }}">All Equipment</a>
            <a href="{{ route('quote.index') }}">Quote List @if($quoteCount > 0) ({{ $quoteCount }}) @endif</a>
        </section>
        <section>
            <p class="site-footer__eyebrow">Quick Links</p>
            @foreach($navigation as $item)
                <a href="{{ route($item['route']) }}">{{ $item['label'] }}</a>
            @endforeach
            @if(Route::has('pages.privacy-policy')) <a href="{{ route('pages.privacy-policy') }}">Privacy Policy</a> @endif
            @if(Route::has('pages.terms')) <a href="{{ route('pages.terms') }}">Terms</a> @endif
        </section>
        <section>
            <p class="site-footer__eyebrow">Contact</p>
            <a href="tel:{{ config('site.contact.phone_tel') }}">{{ config('site.contact.phone') }}</a>
            <a href="mailto:{{ config('site.contact.email') }}">{{ config('site.contact.email') }}</a>
            <address>{{ config('site.contact.address') }}</address>
            <a href="{{ config('site.contact.maps_url') }}" target="_blank" rel="noopener">Get Directions ↗</a>
        </section>
    </div>
    <div class="site-footer__bottom">
        <div class="site-container"><p>© {{ date('Y') }} {{ config('site.name') }}. All rights reserved.</p></div>
    </div>
</footer>

@stack('meta_pixel_events')
@include('front.partials.meta.pixel-body-end')
</body>
</html>
