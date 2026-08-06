<section class="trust-bar" aria-label="Moore's Farm Equipment highlights">
    <div class="site-container trust-bar__grid">
        @foreach($items as $index => $item)
            <div class="trust-bar__item" data-reveal data-reveal-delay="{{ $index * 80 }}">
                <span class="trust-bar__number">0{{ $index + 1 }}</span>
                <div><h2>{{ $item['title'] }}</h2><p>{{ $item['description'] }}</p></div>
            </div>
        @endforeach
    </div>
</section>
