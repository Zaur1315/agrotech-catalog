<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'AgroTech Equipment' }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/site.webmanifest') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
<header class="sticky top-0 z-50 border-b bg-white/95 backdrop-blur">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-4 py-4">
        <a href="{{ route('home') }}" class="flex gap-6 items-center text-xl font-extrabold text-slate-950">
            <span class="flex w-13">
                <img src="{{ asset('/images/logo.png') }}" alt="logo">
            </span>
            <span>AgroTech</span>
        </a>

        <nav class="hidden items-center gap-6 text-sm font-semibold text-slate-700 md:flex">
            <a href="{{ route('home') }}" class="hover:text-green-700">Home</a>
            <a href="{{ route('catalog.index') }}" class="hover:text-green-700">Equipment</a>
            <a href="{{ route('contact.index') }}" class="hover:text-green-700">Contact</a>
        </nav>

        <div class="flex items-center gap-3">
            @php
                $quoteCount = app(\App\Services\Cart\QuoteCartService::class)->count();
            @endphp

            <a
                href="{{ route('quote.index') }}"
                class="relative inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-green-700"
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
                    class="hidden rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-bold text-slate-800 transition hover:border-green-700 hover:text-green-700 md:inline-flex"
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
            <div class="text-xl font-bold">AgroTech</div>
            <p class="mt-3 text-sm text-slate-300">
                Reliable agricultural equipment for farms, contractors and field operations.
            </p>
        </div>

        <div>
            <div class="font-semibold">Contact</div>
            <div class="mt-3 space-y-1 text-sm text-slate-300">
                <p>Phone: +1 555 300 4000</p>
                <p>Email: sales@agrotech.test</p>
                <p>Location: Wisconsin, USA</p>
            </div>
        </div>

        <div>
            <div class="font-semibold">Quick links</div>
            <div class="mt-3 space-y-1 text-sm text-slate-300">
                <p><a href="{{ route('catalog.index') }}" class="hover:text-white">Equipment catalog</a></p>
                <p><a href="{{ url('/admin') }}" class="hover:text-white">Admin panel</a></p>
                <p><a href="{{ route('contact.index') }}" class="hover:text-white">Contact us</a></p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
