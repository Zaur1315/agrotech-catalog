@if($product->specifications->isNotEmpty())
    <section class="product-section" data-reveal>
        <p class="section-eyebrow">Equipment details</p>
        <h2 class="section-title">Specifications</h2>
        <dl class="spec-list spec-list--full">
            @foreach($product->specifications as $attribute)
                @if($attribute->name && $attribute->value)<div><dt>{{ $attribute->name }}</dt><dd>{{ $attribute->value }}</dd></div>@endif
            @endforeach
        </dl>
    </section>
@endif
