@extends('front.layouts.app', ['title' => 'Equipment Inventory'])

@push('seo')
    <meta name="description" content="Browse available farm, construction, utility, and commercial equipment from Moore's Farm Equipment in Gallatin, Tennessee.">
@endpush

@section('content')
    @include('front.components.inventory.hero', ['content' => config('inventory.index')])

    <div class="section-shell inventory-page" x-data="{ open: false }" @open-inventory-filters.window="open = true" @keydown.escape.window="open = false" x-effect="document.body.classList.toggle('overflow-hidden', open)">
        <div class="site-container">
            <div class="inventory-toolbar">
                <div><p class="section-eyebrow">Available Equipment</p><h2 class="section-title">Browse current inventory</h2><p class="inventory-results">{{ $products->total() }} {{ Str::plural('item', $products->total()) }}</p></div>
                <div class="inventory-toolbar__actions">
                    <button type="button" class="btn-outline mobile-filter-trigger" @click="open = true" :aria-expanded="open.toString()" aria-controls="mobile-inventory-filters">Filters</button>
                    <form method="GET" action="{{ request()->url() }}" class="sort-form">
                        @foreach(request()->except(['sort', 'page']) as $key => $value)
                            @if(is_scalar($value) && $value !== '') <input type="hidden" name="{{ $key }}" value="{{ $value }}"> @endif
                        @endforeach
                        <label for="inventory-sort">Sort</label>
                        <select id="inventory-sort" name="sort" class="inventory-input" onchange="this.form.submit()">
                            <option value="newest" @selected($sort === 'newest')>Newest First</option>
                            <option value="price_asc" @selected($sort === 'price_asc')>Price: Low to High</option>
                            <option value="price_desc" @selected($sort === 'price_desc')>Price: High to Low</option>
                            <option value="year_desc" @selected($sort === 'year_desc')>Year: Newest First</option>
                            <option value="year_asc" @selected($sort === 'year_asc')>Year: Oldest First</option>
                            <option value="hours_asc" @selected($sort === 'hours_asc')>Hours: Low to High</option>
                            <option value="horsepower_desc" @selected($sort === 'horsepower_desc')>Horsepower: High to Low</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="inventory-layout">
                    <aside class="inventory-sidebar">
                        <div class="filter-panel"><div class="filter-panel__heading"><h2>Refine Inventory</h2><p>Use the available details to narrow your search.</p></div>@include('front.components.inventory.filters', ['prefix' => 'desktop-filter'])</div>
                        <div class="inventory-help"><p class="section-eyebrow section-eyebrow--gold">Need help?</p><h2>Talk with our team.</h2><p>Call or email Moore's Farm Equipment about a listing or the type of machine you need.</p><a class="btn-primary" href="tel:{{ config('site.contact.phone_tel') }}">Call {{ config('site.contact.phone') }}</a></div>
                    </aside>
                    <div class="inventory-results-area">
                        @include('front.components.inventory.active-filters')
                        <div class="inventory-grid">
                            @forelse($products as $product)
                                <div data-reveal data-reveal-delay="{{ $loop->index * 50 }}">@include('front.components.product-card', ['product' => $product])</div>
                            @empty
                                @include('front.components.inventory.empty-state', ['content' => config('inventory.empty_state'), 'clearUrl' => $currentCategory ? route('catalog.category', $currentCategory) : route('catalog.index')])
                            @endforelse
                        </div>
                        @if($products->hasPages())<div class="inventory-pagination">{{ $products->links('front.components.inventory.pagination') }}</div>@endif
                    </div>
            </div>

            <div id="mobile-inventory-filters" x-cloak x-show="open" x-transition.opacity class="filter-drawer" role="dialog" aria-modal="true" aria-labelledby="mobile-filter-title">
                    <div class="filter-drawer__backdrop" @click="open = false"></div>
                    <div class="filter-drawer__panel" @click.stop>
                        <div class="filter-drawer__header"><div><p class="section-eyebrow">Inventory</p><h2 id="mobile-filter-title">Filters</h2></div><button type="button" class="gallery-control" @click="open = false" aria-label="Close filters">×</button></div>
                        @include('front.components.inventory.filters', ['prefix' => 'mobile-filter'])
                    </div>
            </div>
        </div>
    </div>

    <section class="inventory-cta" data-reveal><div class="site-container inventory-cta__inner"><div><p class="section-eyebrow section-eyebrow--gold">Need help finding the right equipment?</p><h2>Call or email our team.</h2><p>Discuss the type of machine you are looking for with Moore's Farm Equipment.</p></div><div class="home-hero__actions"><a class="btn-primary" href="tel:{{ config('site.contact.phone_tel') }}">Call {{ config('site.contact.phone') }}</a><a class="btn-outline btn-outline--light" href="{{ route('contact.index') }}">Contact Us</a></div></div></section>
@endsection
