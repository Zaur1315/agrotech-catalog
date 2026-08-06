<section class="page-hero page-hero--inventory" style="--page-hero-image: url('{{ asset($content['hero_image']) }}')">
    <div class="page-hero__overlay"></div>
    <div class="site-container page-hero__inner">
        @include('front.components.breadcrumbs', ['items' => [['label' => 'Inventory']]])
        <div class="page-hero__copy" data-reveal>
            <p class="section-eyebrow section-eyebrow--gold">{{ $content['eyebrow'] }}</p>
            <h1>{{ $content['title'] }}</h1>
            <p>{{ $content['description'] }}</p>
        </div>
    </div>
</section>
