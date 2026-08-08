@props(['content', 'crumb', 'actions' => false])

@php
    $image = file_exists(public_path($content['image'])) ? $content['image'] : $content['fallback'];
@endphp

<section class="public-page-hero" style="--public-hero-image: url('{{ asset($image) }}')">
    <div class="public-page-hero__overlay"></div>
    <div class="site-container public-page-hero__inner">
        @include('front.components.breadcrumbs', ['items' => [['label' => $crumb]]])
        <div class="public-page-hero__copy" data-reveal>
            <p class="section-eyebrow section-eyebrow--gold">{{ $content['eyebrow'] }}</p>
            <h1>{{ $content['title'] }}</h1>
            <p>{{ $content['description'] }}</p>
            @if($actions)
                <div class="public-actions"><a class="btn-primary" href="{{ route('contact.index') }}">Contact Our Team</a><a class="btn-outline btn-outline--light" href="tel:{{ config('site.contact.phone_tel') }}">Call Us</a></div>
            @endif
        </div>
    </div>
</section>
