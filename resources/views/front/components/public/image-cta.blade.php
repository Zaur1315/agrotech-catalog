@props(['content', 'primaryRoute' => 'contact.index', 'primaryLabel' => 'Contact Us', 'secondaryRoute' => null, 'secondaryLabel' => null])

@php
    $image = file_exists(public_path($content['image'])) ? $content['image'] : $content['fallback'];
@endphp

<section class="public-image-cta" style="--public-cta-image: url('{{ asset($image) }}')" data-reveal>
    <div class="public-image-cta__overlay"></div>
    <div class="site-container public-image-cta__inner">
        <p class="section-eyebrow section-eyebrow--gold">Moore's Farm Equipment</p>
        <h2 class="section-title section-title--light">{{ $content['title'] }}</h2>
        <p>{{ $content['description'] }}</p>
        <div class="public-actions">
            <a class="btn-primary" href="{{ route($primaryRoute) }}">{{ $primaryLabel }}</a>
            @if($secondaryRoute && $secondaryLabel)
                <a class="btn-outline btn-outline--light" href="{{ route($secondaryRoute) }}">{{ $secondaryLabel }}</a>
            @endif
        </div>
    </div>
</section>
