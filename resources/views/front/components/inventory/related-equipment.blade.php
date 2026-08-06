@if($products->isNotEmpty())
    <section class="section-shell related-section" data-reveal>
        <div class="site-container"><div class="section-header"><div><p class="section-eyebrow">{{ $content['related_eyebrow'] }}</p><h2 class="section-title">{{ $content['related_title'] }}</h2></div><a class="btn-outline" href="{{ route('catalog.index') }}">View All Inventory</a></div><div class="inventory-grid inventory-grid--related">@foreach($products as $relatedProduct)<div>@include('front.components.product-card', ['product' => $relatedProduct])</div>@endforeach</div></div>
    </section>
@endif
