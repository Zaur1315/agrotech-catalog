<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'AgroTech Equipment' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
<header class="border-b bg-white">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4">
        <a href="{{ route('home') }}" class="text-xl font-bold text-green-700">
            AgroTech
        </a>

        <nav class="flex items-center gap-6 text-sm font-medium">
            <a href="{{ route('home') }}" class="hover:text-green-700">Home</a>
            <a href="{{ route('catalog.index') }}" class="hover:text-green-700">Equipment</a>
            <a href="{{ route('quote.index') }}" class="hover:text-green-700">Quote List</a>
            <a href="#contact" class="hover:text-green-700">Contact</a>
            <a href="{{ url('/admin') }}" class="rounded-lg bg-green-700 px-4 py-2 text-white hover:bg-green-800">
                Admin
            </a>
        </nav>
    </div>
</header>

<main>
    @yield('content')
</main>

<footer id="contact" class="mt-16 border-t bg-slate-900 text-white">
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
            </div>
        </div>
    </div>
</footer>
</body>
</html>
