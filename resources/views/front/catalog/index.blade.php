@extends('front.layouts.app', ['title' => $currentCategory?->name ?? 'Equipment Catalog'])

@section('content')
    <section class="border-b bg-white">
        <div class="mx-auto max-w-7xl px-4 py-10">
            <div class="text-sm text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-green-700">Home</a>
                <span class="mx-2">/</span>
                <span>Catalog</span>
            </div>

            <h1 class="mt-4 text-4xl font-bold">
                {{ $currentCategory?->name ?? 'Equipment Catalog' }}
            </h1>

            @if($currentCategory?->description)
                <p class="mt-3 max-w-3xl text-slate-600">
                    {{ $currentCategory->description }}
                </p>
            @endif
        </div>
    </section>

    <section class="mx-auto grid max-w-7xl gap-8 px-4 py-10 lg:grid-cols-[280px_1fr]">
        <aside>
            <form method="GET" class="rounded-2xl border bg-white p-5 shadow-sm">
                <div class="text-lg font-bold">Filters</div>

                <div class="mt-5 space-y-4">
                    <div>
                        <label class="text-sm font-semibold">Brand</label>
                        <select name="brand" class="mt-1 w-full rounded-lg border-slate-300">
                            <option value="">All brands</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" @selected(request('brand') == $brand->id)>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Condition</label>
                        <select name="condition" class="mt-1 w-full rounded-lg border-slate-300">
                            <option value="">Any condition</option>
                            <option value="new" @selected(request('condition') === 'new')>New</option>
                            <option value="used" @selected(request('condition') === 'used')>Used</option>
                            <option value="refurbished" @selected(request('condition') === 'refurbished')>Refurbished
                            </option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-sm font-semibold">Min price</label>
                            <input type="number" name="min_price" value="{{ request('min_price') }}"
                                   class="mt-1 w-full rounded-lg border-slate-300">
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Max price</label>
                            <input type="number" name="max_price" value="{{ request('max_price') }}"
                                   class="mt-1 w-full rounded-lg border-slate-300">
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Sort</label>
                        <select name="sort" class="mt-1 w-full rounded-lg border-slate-300">
                            <option value="">Newest</option>
                            <option value="price_asc" @selected(request('sort') === 'price_asc')>Price: low to high
                            </option>
                            <option value="price_desc" @selected(request('sort') === 'price_desc')>Price: high to low
                            </option>
                            <option value="year_desc" @selected(request('sort') === 'year_desc')>Year: newest</option>
                            <option value="year_asc" @selected(request('sort') === 'year_asc')>Year: oldest</option>
                        </select>
                    </div>

                    <button type="submit"
                            class="w-full rounded-xl bg-green-700 px-4 py-3 font-semibold text-white hover:bg-green-800">
                        Apply filters
                    </button>

                    <a href="{{ $currentCategory ? route('catalog.category', $currentCategory) : route('catalog.index') }}"
                       class="block text-center text-sm font-semibold text-slate-500 hover:text-green-700">
                        Reset
                    </a>
                </div>
            </form>

            <div class="mt-6 rounded-2xl border bg-white p-5 shadow-sm">
                <div class="text-lg font-bold">Categories</div>

                <div class="mt-4 space-y-2">
                    <a href="{{ route('catalog.index') }}"
                       class="block rounded-lg px-3 py-2 text-sm font-medium hover:bg-slate-100 {{ $currentCategory === null ? 'bg-green-50 text-green-700' : '' }}">
                        All equipment
                    </a>

                    @foreach($categories as $category)
                        <a href="{{ route('catalog.category', $category) }}"
                           class="block rounded-lg px-3 py-2 text-sm font-medium hover:bg-slate-100 {{ $currentCategory?->id === $category->id ? 'bg-green-50 text-green-700' : '' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </aside>

        <div>
            <div class="mb-5 flex items-center justify-between">
                <div class="text-sm text-slate-600">
                    Showing {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}
                    of {{ $products->total() }} results
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @forelse($products as $product)
                    @include('front.components.product-card', ['product' => $product])
                @empty
                    <div class="rounded-2xl border bg-white p-8 text-center text-slate-600 md:col-span-2 xl:col-span-3">
                        No equipment found by selected filters.
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </section>
@endsection
