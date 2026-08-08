@props(['content', 'crumb'])

<section class="legal-hero">
    <div class="legal-hero__texture"></div>
    <div class="site-container legal-hero__inner">
        @include('front.components.breadcrumbs', ['items' => [['label' => $crumb]]])
        <div class="legal-hero__copy" data-reveal>
            <p class="section-eyebrow section-eyebrow--gold">{{ $content['eyebrow'] }}</p>
            <h1>{{ $content['title'] }}</h1>
            <p>{{ $content['description'] }}</p>
            <span class="legal-hero__updated">Last Updated: {{ config('legal.updated_at') }}</span>
        </div>
    </div>
</section>
