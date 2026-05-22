@extends('front.layouts.app', ['title' => 'AgroTech Equipment'])

@section('content')
    <section class="bg-slate-900 text-white">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-20 lg:grid-cols-2">
            <div>
                <div class="mb-4 inline-flex rounded-full bg-green-700/20 px-4 py-2 text-sm font-semibold text-green-300">
                    Farm equipment marketplace
                </div>

                <h1 class="text-4xl font-extrabold tracking-tight md:text-6xl">
                    Reliable agricultural equipment for serious work.
                </h1>

                <p class="mt-6 max-w-xl text-lg text-slate-300">
                    Browse tractors, harvesters, balers, utility vehicles and attachments from trusted brands.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('catalog.index') }}" class="rounded-xl bg-green-600 px-6 py-3 font-semibold text-white hover:bg-green-700">
                        Browse equipment
                    </a>

                    <a href="#featured" class="rounded-xl border border-white/20 px-6 py-3 font-semibold text-white hover:bg-white/10">
                        Featured machines
                    </a>
                </div>
            </div>

            <div class="rounded-3xl bg-white/10 p-6">
                <div class="rounded-2xl bg-slate-800 p-8">
                    <div class="text-sm uppercase tracking-wide text-green-300">Available now</div>
                    <div class="mt-4 text-5xl font-bold">{{ $latestProducts->count() }}+</div>
                    <p class="mt-3 text-slate-300">machines ready for quote requests and dealer contact.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14">
        <div class="flex items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-bold">Shop by category</h2>
                <p class="mt-2 text-slate-600">Find equipment by the type of work you need to complete.</p>
            </div>

            <a href="{{ route('catalog.index') }}" class="text-sm font-semibold text-green-700 hover:text-green-800">
                View all
            </a>
        </div>

        <div class="mt-8 grid gap-5 md:grid-cols-2 lg:grid-cols-5">
            @foreach($categories as $category)
                <a href="{{ route('catalog.category', $category) }}" class="rounded-2xl border bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="text-lg font-bold">{{ $category->name }}</div>
                    <p class="mt-2 line-clamp-3 text-sm text-slate-600">
                        {{ $category->description }}
                    </p>
                </a>
            @endforeach
        </div>
    </section>

    <section id="featured" class="mx-auto max-w-7xl px-4 py-14">
        <div class="flex items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-bold">Featured equipment</h2>
                <p class="mt-2 text-slate-600">Selected machines for farms and contractors.</p>
            </div>
        </div>

        <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($featuredProducts as $product)
                @include('front.components.product-card', ['product' => $product])
            @empty
                <p class="text-slate-600">No featured equipment yet.</p>
            @endforelse
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14">
        <div>
            <h2 class="text-3xl font-bold">Latest arrivals</h2>
            <p class="mt-2 text-slate-600">Recently added agricultural machines.</p>
        </div>

        <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($latestProducts as $product)
                @include('front.components.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>
@endsection
