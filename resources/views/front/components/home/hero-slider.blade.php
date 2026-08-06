@php
    $slides = $hero['slides'] ?? [];
    $hasSlides = count($slides) > 0;
@endphp

<section class="home-hero" x-data="heroSlider({{ json_encode(['interval' => $hero['interval'] ?? 6500, 'autoplay' => $hero['autoplay'] ?? true, 'count' => count($slides)]) }})" x-init="init()" @mouseenter="pause()" @mouseleave="resume()" @focusin="pause()" @focusout="if (!$event.currentTarget.contains($event.relatedTarget)) resume()" @keydown.left.prevent="previous()" @keydown.right.prevent="next()" tabindex="0" aria-label="Featured equipment">
    @foreach($slides as $index => $slide)
        <article class="home-hero__slide" :class="{ 'is-active': current === {{ $index }} }" :aria-hidden="current !== {{ $index }}">
            <img src="{{ asset($slide['image']) }}" width="1672" height="941" alt="{{ $slide['image_alt'] }}" @if($index > 0) loading="lazy" @endif>
            <div class="home-hero__overlay"></div>
            <div class="site-container home-hero__content" data-reveal>
                <p class="section-eyebrow section-eyebrow--gold">{{ $slide['eyebrow'] }}</p>
                @if($index === 0)
                    <h1>{{ $slide['title'] }}</h1>
                @else
                    <h2>{{ $slide['title'] }}</h2>
                @endif
                <p class="home-hero__description">{{ $slide['description'] }}</p>
                <div class="home-hero__actions">
                    @if(isset($slide['primary_cta']['route']) && Route::has($slide['primary_cta']['route']))
                        <a class="btn-primary" href="{{ route($slide['primary_cta']['route']) }}">{{ $slide['primary_cta']['label'] }}</a>
                    @endif
                    @if(isset($slide['secondary_cta']['route']) && Route::has($slide['secondary_cta']['route']))
                        <a class="btn-outline btn-outline--light" href="{{ route($slide['secondary_cta']['route']) }}">{{ $slide['secondary_cta']['label'] }}</a>
                    @elseif(!empty($slide['secondary_cta']['url']))
                        <a class="btn-outline btn-outline--light" href="{{ $slide['secondary_cta']['url'] }}" @if(str_starts_with($slide['secondary_cta']['url'], 'http')) target="_blank" rel="noopener" @endif>{{ $slide['secondary_cta']['label'] }}</a>
                    @endif
                </div>
            </div>
        </article>
    @endforeach

    @if($hasSlides)
        <div class="site-container home-hero__controls">
            <button type="button" class="hero-control" @click="previous()" aria-label="Previous slide">←</button>
            <div class="hero-dots" aria-label="Choose a slide">
                @foreach($slides as $index => $slide)
                    <button type="button" class="hero-dot" :class="{ 'is-active': current === {{ $index }} }" @click="goTo({{ $index }})" :aria-current="current === {{ $index }} ? 'true' : undefined" aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
            <button type="button" class="hero-control" @click="next()" aria-label="Next slide">→</button>
        </div>
    @endif
</section>
