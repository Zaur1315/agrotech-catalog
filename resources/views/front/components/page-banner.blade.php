@props([
    'title',
    'description' => null,
    'badge' => null,
    'statLabel' => null,
    'statValue' => null,
])

<section class="relative overflow-hidden border-b bg-slate-950 text-white">
    <div class="absolute inset-0 bg-gradient-to-br from-green-900/70 via-slate-950 to-slate-950"></div>
    <div class="absolute -right-20 -top-24 h-72 w-72 rounded-full bg-green-500/20 blur-3xl"></div>
    <div class="absolute -bottom-24 left-20 h-72 w-72 rounded-full bg-emerald-400/10 blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl px-4 py-12 md:py-16">
        <div class="text-sm text-slate-300">
            <a href="{{ route('home') }}" class="hover:text-green-300">Home</a>

            @if($badge)
                <span class="mx-2 text-slate-500">/</span>
                <span>{{ $badge }}</span>
            @endif
        </div>

        <div class="mt-5 grid gap-6 lg:grid-cols-[1fr_auto] lg:items-end">
            <div>
                <h1 class="max-w-4xl text-4xl font-extrabold tracking-tight md:text-5xl">
                    {{ $title }}
                </h1>

                @if($description)
                    <p class="mt-4 max-w-3xl text-base leading-7 text-slate-300 md:text-lg">
                        {{ $description }}
                    </p>
                @endif
            </div>

            @if($statLabel && $statValue !== null)
                <div class="rounded-2xl border border-white/10 bg-white/10 px-5 py-4 shadow-lg backdrop-blur">
                    <div class="text-sm text-slate-300">{{ $statLabel }}</div>
                    <div class="mt-1 text-3xl font-bold text-white">{{ $statValue }}</div>
                </div>
            @endif
        </div>
    </div>
</section>
