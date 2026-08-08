<section class="section section-shell" data-reveal>
    <div class="site-container content-split">
        <div class="content-split__media">
            <img src="{{ asset($section['image']) }}" width="1000" height="760" loading="lazy"
                 alt="{{ $section['image_alt'] }}">
            <span class="image-overlay"></span><span class="content-split__badge">⭐</span>
        </div>
        <div class="content-split__body">
            <p class="section-eyebrow">{{ $section['eyebrow'] }}</p>
            <h2 class="section-title">{{ $section['title'] }}</h2>
            <p class="section-description">{{ $section['description'] }}</p>
            <div class="feature-list">@foreach($section['items'] as $index => $item)
                    <div class="feature-list__item" data-reveal data-reveal-delay="{{ $index * 80 }}">
                        <span>0{{ $index + 1 }}</span>
                        <div><h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['description'] }}</p></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
