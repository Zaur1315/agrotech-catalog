@extends('front.layouts.app', ['title' => $product->name])

@php
    $description = $product->short_description ?: ($product->category?->name ? $product->category->name . ' equipment from ' . config('site.name') . '.' : 'Equipment available from ' . config('site.name') . '.');
    $breadcrumbItems = [['label' => 'Inventory', 'url' => route('catalog.index')]];
    if ($product->category) $breadcrumbItems[] = ['label' => $product->category->name, 'url' => route('catalog.category', $product->category)];
    $breadcrumbItems[] = ['label' => $product->name];
@endphp

@push('seo')
    <meta name="description" content="{{ Str::limit(strip_tags($description), 155) }}">
    <link rel="canonical" href="{{ request()->url() }}">
    <meta property="og:title" content="{{ $product->name }} | {{ config('site.name') }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($description), 155) }}">
    <meta property="og:type" content="product">
    <meta property="og:image" content="{{ $product->main_image_url }}">
@endpush

@section('content')
    <div class="product-page">
        <div class="site-container product-breadcrumbs">@include('front.components.breadcrumbs', ['items' => $breadcrumbItems])</div>
        <main class="section-shell product-main">
            <div class="site-container">
                <div class="product-layout">
                    <div><div class="product-gallery-wrap">@include('front.components.inventory.gallery', ['product' => $product])</div></div>
                    <div class="product-summary-column">
                        <div class="product-summary" data-reveal>
                            @if($product->category)<p class="section-eyebrow">{{ $product->category->name }}</p>@endif
                            <h1>{{ $product->name }}</h1>
                            @if($product->short_description)<p class="product-lead">{{ $product->short_description }}</p>@endif
                            <div class="product-summary__price">{{ $product->formatted_price }}</div>
                            <div class="product-summary__meta">
                                @if($product->status)<span class="status-badge status-badge--{{ $product->status }}">{{ ucfirst($product->status) }}</span>@endif
                                @if($product->stock_number)<span>Stock # {{ $product->stock_number }}</span>@endif
                                @if($product->location)<span>{{ $product->location }}</span>@endif
                            </div>
                            @include('front.components.inventory.summary', ['product' => $product])
                            @if($product->status === \App\Models\Product::STATUS_AVAILABLE)<a class="btn-primary product-summary__cta" href="#inquiry">Send an Inquiry</a>@else<a class="btn-primary product-summary__cta" href="{{ route('contact.index') }}">Contact Our Team</a>@endif
                        </div>
                        <div class="product-inquiry-desktop">@include('front.components.inventory.inquiry-panel', ['product' => $product, 'content' => config('inventory.show')])</div>
                    </div>
                </div>

                <div class="product-content-grid">
                    <div class="product-content-column">
                        @if($product->description)
                            <section class="product-section" data-reveal><p class="section-eyebrow">Equipment overview</p><h2 class="section-title">About This Equipment</h2><div class="product-description">{!! nl2br(e($product->description)) !!}</div></section>
                        @endif
                        @include('front.components.inventory.specifications', ['product' => $product])
                    </div>
                    <div class="product-content-aside"><div class="product-contact-band"><p class="section-eyebrow section-eyebrow--gold">Questions about this machine?</p><h2>Talk with Moore's Farm Equipment.</h2><a class="btn-primary" href="tel:{{ config('site.contact.phone_tel') }}">Call {{ config('site.contact.phone') }}</a></div></div>
                </div>
            </div>
        </main>
        @include('front.components.inventory.related-equipment', ['products' => $relatedProducts, 'content' => config('inventory.show')])
        @if($product->status === \App\Models\Product::STATUS_AVAILABLE)<div class="product-mobile-bar"><a href="tel:{{ config('site.contact.phone_tel') }}">Call Now</a><a href="#inquiry">Inquire</a></div>@endif
    </div>

    @push('meta_pixel_events')
        @if (config('services.meta.pixel_enabled') && config('services.meta.pixel_id'))
            @php($metaViewContentPayload = ['content_ids' => $metaViewContentEvent['content_ids'], 'content_type' => $metaViewContentEvent['content_type'], 'content_name' => $metaViewContentEvent['content_name'], 'content_category' => $metaViewContentEvent['content_category'], 'value' => $metaViewContentEvent['value'], 'currency' => $metaViewContentEvent['currency']])
            <script>if (typeof fbq === 'function') { fbq('track', 'ViewContent', @json($metaViewContentPayload), {eventID: @json($metaViewContentEvent['event_id'])}); }</script>
        @endif
    @endpush
@endsection
