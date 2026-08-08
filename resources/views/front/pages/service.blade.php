@php($page = config('pages.service'))
@extends('front.layouts.app', ['title' => $page['seo']['title']])

@push('seo')
    <meta name="description" content="{{ $page['seo']['description'] }}">
    <meta property="og:title" content="{{ $page['seo']['title'] }} | {{ config('site.name') }}">
    <meta property="og:description" content="{{ $page['seo']['description'] }}">
    @php($heroImage = file_exists(public_path($page['hero']['image'])) ? $page['hero']['image'] : $page['hero']['fallback'])
    <meta property="og:image" content="{{ asset($heroImage) }}">
@endpush

@section('content')
    @include('front.components.public.page-hero', ['content' => $page['hero'], 'crumb' => 'Service', 'actions' => true])

    <section class="section-shell public-intro" data-reveal>
        <div class="site-container public-split public-split--service">
            @php($introImage = file_exists(public_path($page['intro']['image'])) ? $page['intro']['image'] : $page['intro']['fallback'])
            <div class="public-split__media">
                <img src="{{ asset($introImage) }}" width="1000" height="760" loading="lazy" alt="{{ $page['intro']['image_alt'] }}">
                <span class="image-overlay"></span>
                <span class="public-split__badge">⭐</span>
            </div>
            <div class="public-split__body">
                <p class="section-eyebrow">{{ $page['intro']['eyebrow'] }}</p>
                <h2 class="section-title">{{ $page['intro']['title'] }}</h2>
                <p class="section-description">{{ $page['intro']['description'] }}</p>
                <p class="public-copy">{{ $page['intro']['detail'] }}</p>
                <a class="public-phone-link" href="tel:{{ config('site.contact.phone_tel') }}">Call {{ config('site.contact.phone') }} <span aria-hidden="true">↗</span></a>
            </div>
        </div>
    </section>

    <section class="public-dark-section public-support" data-reveal>
        <div class="site-container">
            <div class="section-header section-header--dark">
                <div><p class="section-eyebrow section-eyebrow--gold">What We Can Discuss</p><h2 class="section-title">Support for the Next Step</h2></div>
                <p class="section-description">{{ $page['support_intro'] }}</p>
            </div>
            <div class="public-support-grid">
                @foreach($page['services'] as $service)
                    <article class="public-support-item" data-reveal data-reveal-delay="{{ $loop->index * 90 }}">
                        <span class="public-number">0{{ $loop->iteration }}</span>
                        <h3>{{ $service['title'] }}</h3>
                        <p>{{ $service['description'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="public-image-break" data-reveal>
        @php($visualImage = file_exists(public_path($page['visual']['image'])) ? $page['visual']['image'] : $page['visual']['fallback'])
        <img src="{{ asset($visualImage) }}" width="1800" height="760" loading="lazy" alt="{{ $page['visual']['image_alt'] }}">
        <div class="public-image-break__overlay"></div>
        <div class="site-container public-image-break__content"><p class="section-eyebrow section-eyebrow--gold">Start With the Details</p><h2>{{ $page['visual']['title'] }}</h2><p>{{ $page['visual']['description'] }}</p></div>
    </section>

    <section class="section-shell public-process" data-reveal>
        <div class="site-container">
            <div class="section-header"><div><p class="section-eyebrow">A Clear Conversation</p><h2 class="section-title">How It Works</h2></div></div>
            <div class="public-process-grid">
                @foreach($page['process'] as $step)
                    <article class="public-process-step" data-reveal data-reveal-delay="{{ $loop->index * 100 }}"><span>{{ $step['number'] }}</span><h3>{{ $step['title'] }}</h3><p>{{ $step['description'] }}</p></article>
                @endforeach
            </div>
        </div>
    </section>

    @include('front.components.public.image-cta', ['content' => $page['cta'], 'primaryRoute' => 'contact.index', 'primaryLabel' => 'Contact Us', 'secondaryRoute' => 'catalog.index', 'secondaryLabel' => 'View Inventory'])
@endsection
