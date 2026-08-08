<section class="section section-shell section-shell--muted" data-reveal>
    <div class="site-container">
        <div class="section-header"><div><p class="section-eyebrow">Shop by type</p><h2 class="section-title">Browse by category</h2><p class="section-description">Find equipment by the type of work you need to complete.</p></div><a class="btn-outline" href="{{ route('catalog.index') }}">View All Inventory</a></div>
        <div class="category-grid">
            @forelse($categories as $category)
                @php
                    $categoryImage = match ($category->slug) {
                        'backhoes' => 'images/home/categories/backhoes.webp',
                        'wheel-loaders' => 'images/home/categories/wheel-loaders.webp',
                        'skid-steer-loaders' => 'images/home/categories/skid-steer-loaders.webp',
                        'tractors' => 'images/home/categories/tractors.webp',
                        default => 'images/home/applications/utility-equipment.webp',
                    };
                @endphp
                <a class="image-card category-card" href="{{ route('catalog.category', $category) }}" data-reveal data-reveal-delay="{{ $loop->index * 80 }}">
                    <img src="{{ asset($categoryImage) }}" width="900" height="650" loading="lazy" alt="{{ $category->name }} equipment">
                    <span class="image-overlay"></span><span class="category-card__content"><span class="section-eyebrow section-eyebrow--gold">Inventory</span><h3>{{ $category->name }}</h3>@if($category->description)<span>{{ Str::limit($category->description, 100) }}</span>@endif<span class="card-link">Browse category →</span></span>
                </a>
            @empty
                <div class="empty-state"><h3>Inventory categories coming soon</h3><p>Browse all available equipment to see current listings.</p><a class="btn-secondary" href="{{ route('catalog.index') }}">View Inventory</a></div>
            @endforelse
        </div>
    </div>
</section>
