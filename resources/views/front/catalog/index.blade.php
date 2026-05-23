@extends('front.layouts.app', ['title' => $currentCategory?->name ?? 'Equipment Catalog'])

@section('content')
    @include('front.components.page-banner', [
        'title' => $currentCategory?->name ?? 'Equipment Catalog',
        'description' => $currentCategory?->description ?? 'Browse available agricultural equipment, compare specifications and add machines to your quote list.',
        'badge' => 'Catalog',
        'statLabel' => 'Available results',
        'statValue' => $products->total(),
    ])

    <section class="mx-auto grid max-w-7xl gap-8 px-4 py-10 lg:grid-cols-[300px_1fr]">
        <aside class="space-y-6">
            <form method="GET"
                  class="overflow-hidden rounded-3xl border border-slate-800 bg-slate-950 text-white shadow-xl">
                <div class="border-b border-white/10 bg-white/5 px-5 py-4">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <div class="text-lg font-bold">Refine inventory</div>
                            <p class="mt-1 text-xs leading-5 text-slate-400">
                                Filter equipment by brand, condition, year and price.
                            </p>
                        </div>

                        <a
                            href="{{ $currentCategory ? route('catalog.category', $currentCategory) : route('catalog.index') }}"
                            class="rounded-full border border-white/10 px-3 py-1.5 text-xs font-bold text-slate-300 transition hover:border-green-400 hover:text-green-300"
                        >
                            Reset
                        </a>
                    </div>
                </div>

                <div class="space-y-5 p-5">
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-200">Brand</label>
                        <select
                            name="brand"
                            class="block w-full rounded-xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-white shadow-sm outline-none transition focus:border-green-400 focus:ring-4 focus:ring-green-500/10"
                        >
                            <option class="text-slate-900" value="">All brands</option>
                            @foreach($brands as $brand)
                                <option class="text-slate-900"
                                        value="{{ $brand->id }}" @selected(request('brand') == $brand->id)>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-200">Condition</label>
                        <select
                            name="condition"
                            class="block w-full rounded-xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-white shadow-sm outline-none transition focus:border-green-400 focus:ring-4 focus:ring-green-500/10"
                        >
                            <option class="text-slate-900" value="">Any condition</option>
                            <option class="text-slate-900" value="new" @selected(request('condition') === 'new')>New
                            </option>
                            <option class="text-slate-900" value="used" @selected(request('condition') === 'used')>
                                Used
                            </option>
                            <option class="text-slate-900"
                                    value="refurbished" @selected(request('condition') === 'refurbished')>Refurbished
                            </option>
                        </select>
                    </div>

                    <div>
                        <div class="mb-1.5 flex items-center justify-between">
                            <label class="block text-sm font-semibold text-slate-200">Price range</label>
                            <span class="text-xs text-slate-500">USD</span>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <input
                                type="number"
                                name="min_price"
                                value="{{ request('min_price') }}"
                                class="block w-full rounded-xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-white shadow-sm outline-none transition placeholder:text-slate-500 focus:border-green-400 focus:ring-4 focus:ring-green-500/10"
                                placeholder="Min"
                            >

                            <input
                                type="number"
                                name="max_price"
                                value="{{ request('max_price') }}"
                                class="block w-full rounded-xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-white shadow-sm outline-none transition placeholder:text-slate-500 focus:border-green-400 focus:ring-4 focus:ring-green-500/10"
                                placeholder="Max"
                            >
                        </div>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-200">Model year</label>

                        <div class="grid grid-cols-2 gap-3">
                            <input
                                type="number"
                                name="year_from"
                                value="{{ request('year_from') }}"
                                class="block w-full rounded-xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-white shadow-sm outline-none transition placeholder:text-slate-500 focus:border-green-400 focus:ring-4 focus:ring-green-500/10"
                                placeholder="From"
                            >

                            <input
                                type="number"
                                name="year_to"
                                value="{{ request('year_to') }}"
                                class="block w-full rounded-xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-white shadow-sm outline-none transition placeholder:text-slate-500 focus:border-green-400 focus:ring-4 focus:ring-green-500/10"
                                placeholder="To"
                            >
                        </div>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-200">Sort results</label>
                        <select
                            name="sort"
                            class="block w-full rounded-xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-white shadow-sm outline-none transition focus:border-green-400 focus:ring-4 focus:ring-green-500/10"
                        >
                            <option class="text-slate-900" value="">Newest first</option>
                            <option class="text-slate-900" value="price_asc" @selected(request('sort') === 'price_asc')>
                                Price: low to high
                            </option>
                            <option class="text-slate-900"
                                    value="price_desc" @selected(request('sort') === 'price_desc')>Price: high to low
                            </option>
                            <option class="text-slate-900" value="year_desc" @selected(request('sort') === 'year_desc')>
                                Year: newest
                            </option>
                            <option class="text-slate-900" value="year_asc" @selected(request('sort') === 'year_asc')>
                                Year: oldest
                            </option>
                        </select>
                    </div>

                    <button
                        type="submit"
                        class="w-full rounded-xl bg-green-600 px-4 py-3.5 text-sm font-black uppercase tracking-wide text-white shadow-lg shadow-green-900/30 transition hover:bg-green-500"
                    >
                        Apply filters
                    </button>
                </div>
            </form>

            <div class="rounded-2xl border bg-white p-5 shadow-sm">
                <div class="text-lg font-bold">Categories</div>

                <div class="mt-4 space-y-2">
                    <a href="{{ route('catalog.index') }}"
                       class="flex items-center justify-between rounded-xl px-3 py-2 text-sm font-medium hover:bg-slate-100 {{ $currentCategory === null ? 'bg-green-50 text-green-700' : '' }}">
                        <span>All equipment</span>
                    </a>

                    @foreach($categories as $category)
                        <a href="{{ route('catalog.category', $category) }}"
                           class="flex items-center justify-between rounded-xl px-3 py-2 text-sm font-medium hover:bg-slate-100 {{ $currentCategory?->id === $category->id ? 'bg-green-50 text-green-700' : '' }}">
                            <span>{{ $category->name }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="rounded-2xl bg-slate-900 p-5 text-white shadow-sm">
                <div class="text-lg font-bold">Need help choosing?</div>
                <p class="mt-2 text-sm leading-6 text-slate-300">
                    Add machines to the quote list or send a direct request from the product page.
                </p>

                <a href="{{ route('quote.index') }}"
                   class="mt-4 inline-flex rounded-xl bg-green-600 px-4 py-2 text-sm font-semibold hover:bg-green-700">
                    Open quote list
                </a>
            </div>
        </aside>

        <div>
            @if(session('success'))
                <div
                    class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
                <div class="text-sm text-slate-600">
                    Showing
                    <span class="font-semibold text-slate-900">{{ $products->firstItem() ?? 0 }}</span>
                    -
                    <span class="font-semibold text-slate-900">{{ $products->lastItem() ?? 0 }}</span>
                    of
                    <span class="font-semibold text-slate-900">{{ $products->total() }}</span>
                    results
                </div>

                @if(request()->query())
                    <div class="flex flex-wrap gap-2">
                        @foreach(request()->query() as $key => $value)
                            @continue($value === null || $value === '')

                            <span
                                class="rounded-full border border-green-200 bg-green-50 px-3 py-1.5 text-xs font-bold text-green-700">
                                {{ str_replace('_', ' ', ucfirst($key)) }}: {{ $value }}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @forelse($products as $product)
                    @include('front.components.product-card', ['product' => $product])
                @empty
                    <div class="rounded-2xl border bg-white p-10 text-center shadow-sm md:col-span-2 xl:col-span-3">
                        <h2 class="text-2xl font-bold">No equipment found</h2>
                        <p class="mt-3 text-slate-600">
                            Try changing filters or browse all available equipment.
                        </p>

                        <a href="{{ $currentCategory ? route('catalog.category', $currentCategory) : route('catalog.index') }}"
                           class="mt-6 inline-flex rounded-xl bg-green-700 px-6 py-3 font-semibold text-white hover:bg-green-800">
                            Reset filters
                        </a>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </section>
@endsection
