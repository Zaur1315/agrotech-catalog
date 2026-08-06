<section class="section section-shell" data-reveal>
    <div class="site-container">
        <div class="section-header">
            <div><p class="section-eyebrow">Featured inventory</p><h2 class="section-title">Selected equipment</h2><p class="section-description">Review available equipment and request pricing, condition details, or next steps from our team.</p></div>
            <a class="btn-outline" href="{{ route('catalog.index') }}">View All Inventory</a>
        </div>
        <div class="home-product-grid">
            @forelse($products as $product)
                @include('front.components.product-card', ['product' => $product])
            @empty
                <div class="empty-state"><h3>No featured equipment yet</h3><p>Contact us to ask about current inventory and upcoming equipment.</p><a class="btn-secondary" href="{{ route('contact.index') }}">Contact Us</a></div>
            @endforelse
        </div>
    </div>
</section>
