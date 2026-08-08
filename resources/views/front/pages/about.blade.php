@php($page = config('pages.about'))
@extends('front.layouts.app', ['title' => $page['seo']['title']])

@push('seo')
    <meta name="description" content="{{ $page['seo']['description'] }}">
    <meta property="og:title" content="{{ $page['seo']['title'] }} | {{ config('site.name') }}">
    <meta property="og:description" content="{{ $page['seo']['description'] }}">
    @php($heroImage = file_exists(public_path($page['hero']['image'])) ? $page['hero']['image'] : $page['hero']['fallback'])
    <meta property="og:image" content="{{ asset($heroImage) }}">
@endpush

@section('content')
    @include('front.components.public.page-hero', ['content' => $page['hero'], 'crumb' => 'About Us'])

    <section class="section-shell public-about-intro" data-reveal>
        <div class="site-container public-split public-split--about">
            <div class="public-split__body"><p class="section-eyebrow">{{ $page['intro']['eyebrow'] }}</p>
                <h2 class="section-title">{{ $page['intro']['title'] }}</h2>
                <p class="section-description">{{ $page['intro']['description'] }}</p>
                <p class="public-copy">{{ $page['intro']['detail'] }}</p>
                <div class="public-address-lockup"><strong>{{ config('site.name') }}</strong>
                    <address>{{ config('site.contact.address') }}</address>
                </div>
            </div>
            @php($introImage = file_exists(public_path($page['intro']['image'])) ? $page['intro']['image'] : $page['intro']['fallback'])
            <div class="public-split__media"><img src="{{ asset($introImage) }}" width="1000" height="760"
                                                  loading="lazy" alt="{{ $page['intro']['image_alt'] }}"><span
                    class="image-overlay"></span><span class="public-split__badge">⭐</span></div>
        </div>
    </section>

    <section class="public-principles" data-reveal>
        <div class="site-container">
            <div class="section-header">
                <div><p class="section-eyebrow">Our Approach</p>
                    <h2 class="section-title">How We Approach Equipment Sales</h2></div>
            </div>
            <div class="public-principles-list">
                @foreach($page['principles'] as $principle)
                    <article class="public-principle" data-reveal data-reveal-delay="{{ $loop->index * 100 }}">
                        <span>{{ $principle['number'] }}</span>
                        <div><h3>{{ $principle['title'] }}</h3>
                            <p>{{ $principle['description'] }}</p></div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="public-image-break public-image-break--about" data-reveal>
        @php($visualImage = file_exists(public_path($page['visual']['image'])) ? $page['visual']['image'] : $page['visual']['fallback'])
        <img src="{{ asset($visualImage) }}" width="1800" height="760" loading="lazy"
             alt="{{ $page['visual']['image_alt'] }}">
        <div class="public-image-break__overlay"></div>
        <div class="site-container public-image-break__content"><p class="section-eyebrow section-eyebrow--gold">Farm.
                Construction. Utility. Commercial.</p>
            <h2>{{ $page['visual']['title'] }}</h2></div>
    </section>

    <section class="section-shell public-applications" data-reveal>
        <div class="site-container">
            <div class="section-header">
                <div><p class="section-eyebrow">Built Around the Work</p>
                    <h2 class="section-title">Equipment for Different Types of Work</h2></div>
            </div>
            <div class="public-application-words">@foreach($page['applications'] as $application)
                    <div><span>{{ $application['number'] }}</span>
                        <h3>{{ $application['title'] }}</h3></div>
                @endforeach</div>
        </div>
    </section>

    <section class="public-location" data-reveal>
        <div class="site-container public-location__grid">
            <div class="public-location__body"><p class="section-eyebrow">{{ $page['location']['eyebrow'] }}</p>
                <h2 class="section-title">{{ $page['location']['title'] }}</h2>
                <p class="section-description">{{ $page['location']['description'] }}</p>
                <address class="public-location__address">{{ config('site.contact.address') }}</address>
                <div class="public-location__links"><a
                        href="tel:{{ config('site.contact.phone_tel') }}">{{ config('site.contact.phone') }}</a><a
                        href="mailto:{{ config('site.contact.email') }}">{{ config('site.contact.email') }}</a><a
                        href="{{ config('site.contact.maps_url') }}" target="_blank" rel="noopener">Get Directions ↗</a>
                </div>
            </div>
            @php($locationImage = file_exists(public_path($page['location']['image'])) ? $page['location']['image'] : $page['location']['fallback'])
            <div class="public-location__media"><img src="{{ asset($locationImage) }}" width="1000" height="700"
                                                     loading="lazy" alt="{{ $page['location']['image_alt'] }}"><span
                    class="image-overlay"></span></div>
        </div>
    </section>

    @include('front.components.public.image-cta', ['content' => $page['cta'], 'primaryRoute' => 'catalog.index', 'primaryLabel' => 'View Inventory', 'secondaryRoute' => 'contact.index', 'secondaryLabel' => 'Contact Us'])
@endsection
