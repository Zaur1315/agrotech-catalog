@php use App\Services\Cart\QuoteCartService; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' | ' . config('site.name') : config('site.name') }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/site.webmanifest') }}">

    @include('front.partials.meta.pixel-head')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
@php
    $quoteCount = app(QuoteCartService::class)->count();
@endphp
<header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-3 px-4 py-3 lg:gap-6 lg:py-4">
        <a href="{{ route('home') }}"
           class="flex min-w-0 items-center gap-3 text-lg font-extrabold text-slate-950 md:text-xl">
            <span class="flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-slate-100">
                <img src="{{ asset('/images/logo.png') }}" alt="{{ config('site.name') }} logo"
                     class="h-full w-full object-contain">
            </span>

            <span class="truncate">
                {{ config('site.name') }}
            </span>
        </a>

        <nav class="hidden items-center gap-5 text-sm font-semibold text-slate-700 lg:flex">
            <a href="{{ route('home') }}" class="transition hover:text-green-700">Home</a>
            <a href="{{ route('catalog.index') }}" class="transition hover:text-green-700">Inventory</a>
            <a href="{{ route('pages.service') }}" class="transition hover:text-green-700">Service</a>
            <a href="{{ route('pages.delivery') }}" class="transition hover:text-green-700">Delivery</a>
            <a href="{{ route('pages.warranty') }}" class="transition hover:text-green-700">Warranty</a>
            <a href="{{ route('pages.about') }}" class="transition hover:text-green-700">About</a>
            <a href="{{ route('pages.faq') }}" class="transition hover:text-green-700">FAQ</a>
            <a href="{{ route('contact.index') }}" class="transition hover:text-green-700">Contact</a>
        </nav>

        <div class="flex shrink-0 items-center gap-2 lg:gap-3">
            <details class="group lg:hidden">
                <summary
                    class="flex cursor-pointer list-none items-center justify-center rounded-2xl border border-slate-200 bg-white px-3 py-2.5 text-sm font-bold text-slate-900 shadow-sm transition hover:border-green-700 hover:text-green-700 [&::-webkit-details-marker]:hidden">
                    <span class="sr-only">Open menu</span>

                    <span class="grid h-5 w-5 place-items-center">
                        <span class="text-2xl leading-none group-open:hidden">☰</span>
                        <span class="hidden text-2xl leading-none group-open:block">×</span>
                    </span>
                </summary>

                <div
                    class="fixed left-4 right-4 top-[76px] z-50 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-2xl shadow-slate-900/20">
                    <nav class="grid p-2 text-sm font-bold text-slate-800">
                        <a href="{{ route('home') }}" class="rounded-2xl px-4 py-3 transition hover:bg-slate-100">
                            Home
                        </a>

                        <a href="{{ route('catalog.index') }}"
                           class="rounded-2xl px-4 py-3 transition hover:bg-slate-100">
                            Inventory
                        </a>

                        <a href="{{ route('pages.service') }}"
                           class="rounded-2xl px-4 py-3 transition hover:bg-slate-100">
                            Service
                        </a>

                        <a href="{{ route('pages.delivery') }}"
                           class="rounded-2xl px-4 py-3 transition hover:bg-slate-100">
                            Delivery
                        </a>

                        <a href="{{ route('pages.warranty') }}"
                           class="rounded-2xl px-4 py-3 transition hover:bg-slate-100">
                            Warranty
                        </a>

                        <a href="{{ route('pages.about') }}"
                           class="rounded-2xl px-4 py-3 transition hover:bg-slate-100">
                            About
                        </a>

                        <a href="{{ route('pages.faq') }}" class="rounded-2xl px-4 py-3 transition hover:bg-slate-100">
                            FAQ
                        </a>

                        <a href="{{ route('contact.index') }}"
                           class="rounded-2xl px-4 py-3 transition hover:bg-slate-100">
                            Contact
                        </a>

                        <div class="my-2 border-t border-slate-100"></div>

                        <a
                            href="tel:{{ config('site.phone_tel') }}"
                            class="rounded-2xl bg-green-700 px-4 py-3 text-center text-white transition hover:bg-green-800"
                        >
                            Call {{ config('site.phone') }}
                        </a>
                    </nav>
                </div>
            </details>

            <a
                href="tel:{{ config('site.phone_tel') }}"
                class="hidden rounded-2xl border border-slate-200 px-4 py-2.5 text-sm font-bold text-slate-800 transition hover:border-green-700 hover:text-green-700 lg:inline-flex"
            >
                Call {{ config('site.phone') }}
            </a>

            <a
                href="{{ route('quote.index') }}"
                class="relative hidden items-center gap-2 rounded-2xl bg-slate-900 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-green-700 md:inline-flex"
            >
                <span>Quote List</span>

                @if($quoteCount > 0)
                    <span
                        class="inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-green-500 px-1.5 text-xs font-black text-white">
                        {{ $quoteCount }}
                    </span>
                @endif
            </a>

            @auth
                <a
                    href="{{ url('/admin') }}"
                    class="hidden rounded-2xl border border-slate-200 px-4 py-2.5 text-sm font-bold text-slate-800 transition hover:border-green-700 hover:text-green-700 lg:inline-flex"
                >
                    Admin
                </a>
            @endauth
        </div>
    </div>
</header>
<main>
    @yield('content')
</main>

<footer class="mt-16 border-t bg-slate-900 text-white">
    <div class="mx-auto grid max-w-7xl gap-8 px-4 py-10 md:grid-cols-3">
        <div>
            <div class="text-xl font-bold">{{ config('site.name') }}</div>
            <p class="mt-3 text-sm leading-6 text-slate-300">
                Practical equipment inventory, quote requests, delivery questions and local dealership support from
                {{ config('site.city') }}, {{ config('site.state') }}.
            </p>
        </div>

        <div>
            <div class="font-semibold">Contact</div>
            <div class="mt-3 space-y-1 text-sm text-slate-300">
                <p>
                    Phone:
                    <a href="tel:{{ config('site.phone_tel') }}" class="hover:text-green-500">
                        {{ config('site.phone') }}
                    </a>
                </p>

                <p>
                    Email:
                    <a href="mailto:{{ config('site.email') }}" class="hover:text-green-500">
                        {{ config('site.email') }}
                    </a>
                </p>

                <p>
                    Location:
                    @include('front.components.contact.address-link', [
                        'class' => 'hover:text-green-500',
                    ])
                </p>
            </div>
        </div>

        <div>
            <div class="font-semibold">Quick links</div>
            <div class="row flex gap-10">
                <div class="mt-3 grid gap-1 text-sm text-slate-300">
                    <a href="{{ route('pages.delivery') }}" class="hover:text-white">Delivery</a>
                    <a href="{{ route('pages.warranty') }}" class="hover:text-white">Warranty</a>
                    <a href="{{ route('contact.index') }}" class="hover:text-white">Contact us</a>
                </div>
                <div class="mt-3 grid gap-1 text-sm text-slate-300">
                    <a href="{{ route('pages.faq') }}" class="hover:text-white">FAQ</a>
                    <a href="{{ route('pages.terms') }}" class="hover:text-white">Terms of Use</a>
                    <a href="{{ route('pages.privacy-policy') }}" class="hover:text-white">Privacy Policy</a>
                </div>
            </div>
        </div>
    </div>
    <div class="border-t border-white/10">
        <div
            class="mx-auto flex max-w-7xl flex-col gap-2 px-4 py-5 text-xs text-slate-400 md:flex-row md:items-center md:justify-between">
            <p>
                © {{ date('Y') }} {{ config('site.name') }}. All rights reserved.
            </p>

            <p>
                Inventory, pricing and availability must be confirmed directly before purchase.
            </p>
        </div>
    </div>
    <div class="fixed inset-x-4 bottom-4 z-50 md:hidden">
        <div class="rounded-3xl border border-slate-200 bg-white/95 p-2 shadow-2xl shadow-slate-900/20 backdrop-blur">
            <div class="grid grid-cols-3 gap-2">
                <a
                    href="tel:{{ config('site.phone_tel') }}"
                    class="flex flex-col items-center justify-center gap-1 rounded-2xl bg-slate-100 px-2 py-3 text-xs font-bold text-slate-900 transition hover:bg-slate-200"
                >
                    <span class="text-base">☎</span>
                    <span>Call</span>
                </a>

                <a
                    href="{{ config('site.maps_url') }}"
                    target="_blank"
                    rel="noopener"
                    class="flex flex-col items-center justify-center gap-1 rounded-2xl bg-slate-100 px-2 py-3 text-xs font-bold text-slate-900 transition hover:bg-slate-200"
                >
                    <span class="text-base">📍</span>
                    <span>Get directions</span>
                </a>

                <a
                    href="{{ route('quote.index') }}"
                    class="relative flex flex-col items-center justify-center gap-1 rounded-2xl bg-green-700 px-2 py-3 text-xs font-bold text-white shadow-lg shadow-green-900/20 transition hover:bg-green-800"
                >
                    <span class="text-base">✓</span>
                    <span>Quote</span>

                    @if($quoteCount > 0)
                        <span
                            class="absolute right-2 top-2 inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-white px-1.5 text-xs font-black text-green-700">
                        {{ $quoteCount }}
                    </span>
                    @endif
                </a>
            </div>
        </div>
    </div>
</footer>

@stack('meta_pixel_events')

@include('front.partials.meta.pixel-body-end')

</body>
</html>
