@php
    $gallery = $product->images->map(fn ($image) => [
        'full' => $image->url,
        'thumb' => $image->thumbnail_url,
        'alt' => $image->alt ?: $product->name,
    ])->values();

    if ($gallery->isEmpty()) {
        $gallery = collect([['full' => $product->main_image_url, 'thumb' => $product->main_image_url, 'alt' => $product->name]]);
    }
@endphp

<div class="equipment-gallery" x-data="productGallery({ images: @js($gallery) })" @keydown.left.window="if (isLightbox) previous()" @keydown.right.window="if (isLightbox) next()" @keydown.escape.window="if (isLightbox) close()">
    <button type="button" class="equipment-gallery__main" @click="open()" aria-label="Open equipment image gallery">
        <img :src="currentImage.full" :alt="currentImage.alt" width="1200" height="900">
        <span class="equipment-gallery__open" aria-hidden="true">View images ↗</span>
    </button>
    @if($gallery->count() > 1)
        <div class="equipment-gallery__thumbs" aria-label="Equipment image thumbnails">
            @foreach($gallery as $index => $image)
                <button type="button" @click="select({{ $index }})" :class="{ 'is-active': currentIndex === {{ $index }} }" aria-label="View image {{ $index + 1 }}"><img src="{{ $image['thumb'] }}" alt="" width="160" height="120" loading="lazy"></button>
            @endforeach
        </div>
    @endif

    <div x-cloak x-show="isLightbox" x-transition.opacity class="equipment-lightbox" role="dialog" aria-modal="true" aria-label="Equipment image gallery" @click.self="close()" @keydown.tab.prevent="trapFocus($event)">
        <div class="equipment-lightbox__inner">
            <button type="button" class="gallery-control equipment-lightbox__close" x-ref="closeButton" @click="close()" aria-label="Close image gallery">×</button>
            <button type="button" class="gallery-control equipment-lightbox__prev" x-show="images.length > 1" @click="previous()" aria-label="Previous image">←</button>
            <img :src="currentImage.full" :alt="currentImage.alt" width="1600" height="1200">
            <button type="button" class="gallery-control equipment-lightbox__next" x-show="images.length > 1" @click="next()" aria-label="Next image">→</button>
            <p x-text="`${currentIndex + 1} / ${images.length}`"></p>
        </div>
    </div>
</div>
