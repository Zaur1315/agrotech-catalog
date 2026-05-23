@extends('front.layouts.app', ['title' => 'AgroTech Equipment'])

@section('content')
    <section class="relative overflow-hidden bg-slate-950 text-white">
        <div class="absolute inset-0 bg-gradient-to-br from-green-900/70 via-slate-950 to-slate-950"></div>

        <div
            class="relative mx-auto grid max-w-7xl items-center gap-12 px-4 py-20 lg:grid-cols-[1.05fr_0.95fr] lg:py-24">
            <div>
                <div
                    class="mb-5 inline-flex rounded-full border border-green-400/30 bg-green-500/10 px-4 py-2 text-sm font-semibold text-green-200">
                    Agricultural equipment dealer platform
                </div>

                <h1 class="max-w-3xl text-4xl font-extrabold tracking-tight md:text-6xl">
                    Farm equipment built for work, listed for fast quotes.
                </h1>

                <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300">
                    Browse tractors, harvesters, utility vehicles, balers and attachments. Compare key specs,
                    request pricing and send quote requests directly from the catalog.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('catalog.index') }}"
                       class="rounded-xl bg-green-600 px-6 py-3 font-semibold text-white shadow-lg shadow-green-900/30 hover:bg-green-700">
                        Browse equipment
                    </a>

                    <a href="{{ route('quote.index') }}"
                       class="rounded-xl border border-white/20 px-6 py-3 font-semibold text-white hover:bg-white/10">
                        View quote list
                    </a>
                </div>

                <div class="mt-10 grid max-w-xl grid-cols-3 gap-4">
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                        <div class="text-2xl font-bold">{{ $categories->count() }}</div>
                        <div class="mt-1 text-sm text-slate-300">Categories</div>
                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                        <div class="text-2xl font-bold">{{ $latestProducts->count() }}+</div>
                        <div class="mt-1 text-sm text-slate-300">Machines</div>
                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                        <div class="text-2xl font-bold">24h</div>
                        <div class="mt-1 text-sm text-slate-300">Quote response</div>
                    </div>
                </div>
            </div>

            <div class="relative">
                @php
                    $heroProduct = $featuredProducts->first() ?? $latestProducts->first();
                @endphp

                @if($heroProduct)
                    <div class="overflow-hidden rounded-[2rem] border border-white/10 bg-white/10 p-4 shadow-2xl">
                        <img
                            src="{{ $heroProduct->main_image_url }}"
                            alt="{{ $heroProduct->name }}"
                            class="aspect-[4/3] w-full rounded-[1.5rem] object-cover"
                        >

                        <div class="mt-4 rounded-2xl bg-white p-5 text-slate-900">
                            <div class="text-sm font-semibold uppercase tracking-wide text-green-700">
                                Featured equipment
                            </div>

                            <div class="mt-1 text-2xl font-bold">
                                {{ $heroProduct->name }}
                            </div>

                            <div class="mt-3 flex flex-wrap gap-2 text-sm text-slate-600">
                                @if($heroProduct->brand)
                                    <span
                                        class="rounded-full bg-slate-100 px-3 py-1">{{ $heroProduct->brand->name }}</span>
                                @endif

                                @if($heroProduct->year)
                                    <span class="rounded-full bg-slate-100 px-3 py-1">{{ $heroProduct->year }}</span>
                                @endif

                                @if($heroProduct->condition)
                                    <span
                                        class="rounded-full bg-slate-100 px-3 py-1">{{ ucfirst($heroProduct->condition) }}</span>
                                @endif
                            </div>

                            <div class="mt-4 flex items-center justify-between">
                                <div class="text-xl font-bold text-green-700">
                                    {{ $heroProduct->formatted_price }}
                                </div>

                                <a href="{{ route('products.show', $heroProduct) }}"
                                   class="font-semibold text-slate-900 hover:text-green-700">
                                    View details
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14">
        <div class="grid gap-4 md:grid-cols-3">
            <div class="rounded-2xl border bg-white p-6 shadow-sm">
                <div class="text-lg font-bold">Verified inventory</div>
                <p class="mt-2 text-sm leading-6 text-slate-600">
                    Organize listings with categories, brands, specifications, images and availability details.
                </p>
            </div>

            <div class="rounded-2xl border bg-white p-6 shadow-sm">
                <div class="text-lg font-bold">Fast quote workflow</div>
                <p class="mt-2 text-sm leading-6 text-slate-600">
                    Customers can request a single machine or build a quote list with multiple equipment items.
                </p>
            </div>

            <div class="rounded-2xl border bg-white p-6 shadow-sm">
                <div class="text-lg font-bold">Reusable admin base</div>
                <p class="mt-2 text-sm leading-6 text-slate-600">
                    Filament admin panel makes it easy to manage products, leads, images and catalog data.
                </p>
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
                View all equipment
            </a>
        </div>

        <div class="mt-8 grid gap-5 md:grid-cols-2 lg:grid-cols-5">
            @foreach($categories as $category)
                <a
                    href="{{ route('catalog.category', $category) }}"
                    class="group relative overflow-hidden rounded-3xl border border-slate-800 bg-slate-950 p-5 text-white shadow-xl transition duration-200 hover:-translate-y-1 hover:border-green-500 hover:shadow-2xl"
                >
                    <div class="absolute inset-0 bg-gradient-to-br from-green-900/50 via-slate-950 to-slate-950 opacity-80"></div>
                    <div class="absolute -right-10 -top-10 h-28 w-28 rounded-full bg-green-500/20 blur-2xl transition group-hover:bg-green-400/30"></div>

                    <div class="relative">
                        <div class="mb-4 inline-flex rounded-full border border-white/10 bg-white/10 px-3 py-1 text-xs font-bold uppercase tracking-wide text-green-200">
                            Equipment
                        </div>

                        <div class="text-lg font-bold text-white transition group-hover:text-green-200">
                            {{ $category->name }}
                        </div>

                        <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-300">
                            {{ $category->description }}
                        </p>

                        <div class="mt-5 inline-flex items-center text-sm font-bold text-green-300 transition group-hover:text-green-200">
                            Browse category
                            <span class="ml-2 transition group-hover:translate-x-1">→</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <section class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-14">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-bold">Featured equipment</h2>
                    <p class="mt-2 text-slate-600">Selected machines for farms and contractors.</p>
                </div>

                <a href="{{ route('catalog.index') }}"
                   class="hidden rounded-xl border px-5 py-3 text-sm font-semibold hover:bg-slate-50 md:inline-flex">
                    Browse catalog
                </a>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse($featuredProducts as $product)
                    @include('front.components.product-card', ['product' => $product])
                @empty
                    <p class="text-slate-600">No featured equipment yet.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14">
        <div class="rounded-3xl bg-slate-900 p-8 text-white md:p-12">
            <div class="grid gap-8 md:grid-cols-[1fr_auto] md:items-center">
                <div>
                    <h2 class="text-3xl font-bold">Need several machines?</h2>
                    <p class="mt-3 max-w-2xl text-slate-300">
                        Add equipment to your quote list and send one request with all selected machines.
                    </p>
                </div>

                <a href="{{ route('quote.index') }}"
                   class="rounded-xl bg-green-600 px-6 py-3 text-center font-semibold hover:bg-green-700">
                    Open quote list
                </a>
            </div>
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
