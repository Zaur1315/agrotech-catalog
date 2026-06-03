@php use App\Models\Product;@endphp
@extends('front.layouts.app', ['title' => $product->name])

@php
    $statusLabel = match ($product->status) {
        Product::STATUS_AVAILABLE => 'Available',
        Product::STATUS_PENDING => 'Pending',
        Product::STATUS_SOLD => 'Sold',
        Product::STATUS_HIDDEN => 'Hidden',
        default => null,
    };

    $statusClasses = match ($product->status) {
        Product::STATUS_AVAILABLE => 'bg-green-600 text-white',
        Product::STATUS_PENDING => 'bg-amber-500 text-white',
        Product::STATUS_SOLD => 'bg-slate-700 text-white',
        Product::STATUS_HIDDEN => 'bg-red-600 text-white',
        default => 'bg-slate-700 text-white',
    };

    $driveTypeLabel = match ($product->drive_type) {
        Product::DRIVE_TYPE_2WD => '2WD',
        Product::DRIVE_TYPE_4WD => '4WD',
        Product::DRIVE_TYPE_MFWD => 'MFWD',
        default => null,
    };

    $canRequestQuote = $product->status === Product::STATUS_AVAILABLE;
@endphp

@section('content')
    @include('front.components.page-banner', [
        'title' => $product->name,
        'description' => $product->short_description,
        'badge' => 'Equipment details',
        'statLabel' => 'Price',
        'statValue' => $product->formatted_price,
    ])

    <section class="mx-auto max-w-7xl px-4 pt-6">
        @if(session('success'))
            <div class="rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-bold text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-bold text-red-800">
                {{ session('error') }}
            </div>
        @endif
    </section>

    <section class="mx-auto grid max-w-7xl gap-10 px-4 py-10 lg:grid-cols-[1fr_0.9fr]">
        <div>
            <div class="overflow-hidden rounded-[2rem] border bg-white p-3 shadow-sm">
                <img
                    src="{{ $product->main_image_url }}"
                    alt="{{ $product->name }}"
                    class="aspect-[4/3] w-full rounded-[1.5rem] object-cover"
                >
            </div>

            @if($product->images->isNotEmpty())
                <div
                    x-data="productGallery({
                        images: @js($product->images->map(fn ($image) => [
                            'full' => $image->url,
                            'thumb' => $image->thumbnail_url,
                            'alt' => $image->alt ?? $product->name,
                        ])->values()),
                        visibleCount: 8
                    })"
                    x-on:keydown.window.escape="close()"
                    x-on:keydown.window.arrow-left="previous()"
                    x-on:keydown.window.arrow-right="next()"
                    class="mt-4"
                >
                    <div class="grid grid-cols-4 gap-3">
                        <template x-for="(image, imageIndex) in visibleImages" x-bind:key="image.full">
                            <button
                                type="button"
                                x-on:click="open(imageIndex)"
                                class="block overflow-hidden rounded-2xl border bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md"
                            >
                                <img
                                    x-bind:src="image.thumb"
                                    x-bind:alt="image.alt"
                                    loading="lazy"
                                    decoding="async"
                                    class="aspect-square w-full object-cover"
                                >
                            </button>
                        </template>
                    </div>

                    <template x-if="images.length > visibleCount">
                        <div class="mt-4 flex justify-center">
                            <button
                                type="button"
                                x-on:click="toggleExpanded()"
                                class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-black text-slate-800 shadow-sm transition hover:border-green-700 hover:bg-green-50 hover:text-green-700"
                            >
                                <span x-text="isExpanded ? 'Show fewer photos' : 'Show all photos'"></span>

                                <span
                                    class="text-lg leading-none transition-transform"
                                    x-bind:class="isExpanded ? 'rotate-180' : ''"
                                >
                        ↓
                    </span>
                            </button>
                        </div>
                    </template>

                    <div
                        x-show="isOpen"
                        x-cloak
                        class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-950/95 p-3 md:p-6"
                        role="dialog"
                        aria-modal="true"
                    >
                        <button
                            type="button"
                            x-on:click="close()"
                            class="absolute right-4 top-4 z-10 rounded-full bg-white/10 px-4 py-2 text-sm font-black text-white backdrop-blur transition hover:bg-white/20"
                        >
                            Close
                        </button>

                        <button
                            type="button"
                            x-on:click="previous()"
                            class="absolute left-3 top-1/2 z-10 -translate-y-1/2 rounded-full bg-white/10 px-4 py-3 text-2xl font-black text-white backdrop-blur transition hover:bg-white/20 md:left-6"
                            aria-label="Previous image"
                        >
                            ‹
                        </button>

                        <div class="flex max-h-full w-full max-w-6xl flex-col items-center gap-4">
                            <img
                                x-bind:src="currentImage.full"
                                x-bind:alt="currentImage.alt"
                                class="max-h-[78vh] w-auto max-w-full rounded-3xl object-contain shadow-2xl"
                            >

                            <div class="w-full max-w-5xl overflow-hidden px-10">
                                <div
                                    x-ref="lightboxThumbnails"
                                    class="flex gap-2 overflow-x-auto scroll-smooth px-1 pb-2 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden"
                                >
                                    <template x-for="(image, imageIndex) in images" x-bind:key="image.full">
                                        <button
                                            type="button"
                                            x-on:click="setCurrentIndex(imageIndex)"
                                            x-bind:data-gallery-index="imageIndex"
                                            class="h-16 w-16 shrink-0 overflow-hidden rounded-xl border transition md:h-20 md:w-20"
                                            x-bind:class="currentIndex === imageIndex ? 'border-green-400 ring-2 ring-green-400' : 'border-white/20 opacity-70 hover:opacity-100'"
                                        >
                                            <img
                                                x-bind:src="image.thumb"
                                                x-bind:alt="image.alt"
                                                class="h-full w-full object-cover"
                                                loading="lazy"
                                                decoding="async"
                                            >
                                        </button>
                                    </template>
                                </div>
                            </div>

                            <div class="text-sm font-bold text-white/80">
                                <span x-text="currentIndex + 1"></span>
                                /
                                <span x-text="images.length"></span>
                            </div>
                        </div>

                        <button
                            type="button"
                            x-on:click="next()"
                            class="absolute right-3 top-1/2 z-10 -translate-y-1/2 rounded-full bg-white/10 px-4 py-3 text-2xl font-black text-white backdrop-blur transition hover:bg-white/20 md:right-6"
                            aria-label="Next image"
                        >
                            ›
                        </button>
                    </div>
                </div>
            @endif

        </div>

        <div>
            <div class="flex flex-wrap items-center gap-2">
                @if($statusLabel)
                    <span
                        class="rounded-full px-3 py-1 text-xs font-black uppercase tracking-wide shadow {{ $statusClasses }}">
                        {{ $statusLabel }}
                    </span>
                @endif

                <span
                    class="rounded-full bg-green-50 px-3 py-1 text-xs font-black uppercase tracking-wide text-green-700">
                    {{ $product->category?->name }}
                </span>

                @if($product->stock_number)
                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">
                        Stock # {{ $product->stock_number }}
                    </span>
                @elseif($product->sku)
                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">
                        SKU {{ $product->sku }}
                    </span>
                @endif
            </div>

            <h1 class="mt-4 text-4xl font-black tracking-tight text-slate-950 md:text-5xl">
                {{ $product->name }}
            </h1>

            @if($product->short_description)
                <p class="mt-5 text-lg leading-8 text-slate-600">
                    {{ $product->short_description }}
                </p>
            @endif

            <div class="mt-6 rounded-3xl border bg-white p-6 shadow-sm">
                <div class="flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <div class="text-xs font-bold uppercase tracking-wide text-slate-400">Price</div>
                        <div class="mt-1 text-4xl font-black text-green-700">
                            {{ $product->formatted_price }}
                        </div>
                    </div>

                    @if($canRequestQuote)
                        <a href="#quote"
                           class="rounded-2xl bg-green-700 px-6 py-3.5 text-sm font-black uppercase tracking-wide text-white shadow-lg shadow-green-900/20 transition hover:bg-green-800">
                            Request quote
                        </a>
                    @else
                        <a href="{{ route('contact.index') }}"
                           class="rounded-2xl bg-slate-900 px-6 py-3.5 text-sm font-black uppercase tracking-wide text-white transition hover:bg-green-700">
                            Ask availability
                        </a>
                    @endif
                </div>

                <div class="mt-5 grid gap-3 sm:grid-cols-2">
                    @if($canRequestQuote)
                        <form action="{{ route('quote.add', $product) }}" method="POST">
                            @csrf

                            <button
                                type="submit"
                                class="w-full rounded-2xl border border-slate-200 px-5 py-3 text-sm font-bold text-slate-800 transition hover:border-green-700 hover:bg-green-50 hover:text-green-700"
                            >
                                Add to quote list
                            </button>
                        </form>
                    @endif

                    <a href="tel:{{ config('site.phone_tel') }}"
                       class="rounded-2xl border border-slate-200 px-5 py-3 text-center text-sm font-bold text-slate-800 transition hover:border-green-700 hover:bg-green-50 hover:text-green-700">
                        Call {{ config('site.phone') }}
                    </a>
                </div>

                @if(!$canRequestQuote)
                    <p class="mt-4 rounded-2xl bg-slate-50 px-4 py-3 text-sm leading-6 text-slate-600">
                        This equipment is currently marked as {{ strtolower($statusLabel ?? 'unavailable') }}.
                        Contact {{ config('site.name') }} to confirm current availability or similar inventory.
                    </p>
                @endif
            </div>

            <div class="mt-6 grid gap-3 rounded-3xl border bg-white p-5 shadow-sm sm:grid-cols-2">
                @if($product->brand)
                    <div class="rounded-2xl bg-slate-50 px-4 py-3">
                        <div class="text-xs font-semibold uppercase tracking-wide text-slate-400">Brand</div>
                        <div class="mt-1 font-bold text-slate-900">{{ $product->brand->name }}</div>
                    </div>
                @endif

                @if($product->year)
                    <div class="rounded-2xl bg-slate-50 px-4 py-3">
                        <div class="text-xs font-semibold uppercase tracking-wide text-slate-400">Year</div>
                        <div class="mt-1 font-bold text-slate-900">{{ $product->year }}</div>
                    </div>
                @endif

                @if($product->condition)
                    <div class="rounded-2xl bg-slate-50 px-4 py-3">
                        <div class="text-xs font-semibold uppercase tracking-wide text-slate-400">Condition</div>
                        <div class="mt-1 font-bold text-slate-900">{{ ucfirst($product->condition) }}</div>
                    </div>
                @endif

                @if($product->hours_used !== null)
                    <div class="rounded-2xl bg-slate-50 px-4 py-3">
                        <div class="text-xs font-semibold uppercase tracking-wide text-slate-400">Hours</div>
                        <div class="mt-1 font-bold text-slate-900">{{ number_format((int) $product->hours_used) }}</div>
                    </div>
                @endif

                @if($product->horsepower)
                    <div class="rounded-2xl bg-slate-50 px-4 py-3">
                        <div class="text-xs font-semibold uppercase tracking-wide text-slate-400">Horsepower</div>
                        <div class="mt-1 font-bold text-slate-900">{{ $product->horsepower }} HP</div>
                    </div>
                @endif

                @if($driveTypeLabel)
                    <div class="rounded-2xl bg-slate-50 px-4 py-3">
                        <div class="text-xs font-semibold uppercase tracking-wide text-slate-400">Drive type</div>
                        <div class="mt-1 font-bold text-slate-900">{{ $driveTypeLabel }}</div>
                    </div>
                @endif

                @if($product->engine)
                    <div class="rounded-2xl bg-slate-50 px-4 py-3">
                        <div class="text-xs font-semibold uppercase tracking-wide text-slate-400">Engine</div>
                        <div class="mt-1 font-bold text-slate-900">{{ $product->engine }}</div>
                    </div>
                @endif

                @if($product->transmission)
                    <div class="rounded-2xl bg-slate-50 px-4 py-3">
                        <div class="text-xs font-semibold uppercase tracking-wide text-slate-400">Transmission</div>
                        <div class="mt-1 font-bold text-slate-900">{{ $product->transmission }}</div>
                    </div>
                @endif

                @if($product->fuel_type)
                    <div class="rounded-2xl bg-slate-50 px-4 py-3">
                        <div class="text-xs font-semibold uppercase tracking-wide text-slate-400">Fuel type</div>
                        <div class="mt-1 font-bold text-slate-900">{{ $product->fuel_type }}</div>
                    </div>
                @endif

                @if($product->location)
                    <div class="rounded-2xl bg-slate-50 px-4 py-3">
                        <div class="text-xs font-semibold uppercase tracking-wide text-slate-400">Location</div>
                        <div class="mt-1 font-bold text-slate-900">{{ $product->location }}</div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="mx-auto grid max-w-7xl gap-10 px-4 py-10 lg:grid-cols-[1fr_420px]">
        <div class="space-y-8">
            <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                <h2 class="text-2xl font-black">Description</h2>

                @if($product->description)
                    <div class="prose mt-4 max-w-none">
                        {!! $product->description !!}
                    </div>
                @else
                    <p class="mt-4 leading-7 text-slate-600">
                        Contact {{ config('site.name') }} to request more details about this equipment.
                    </p>
                @endif
            </div>

            @if($product->specifications->isNotEmpty())
                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-black">Specifications</h2>

                    <div class="mt-5 overflow-hidden rounded-2xl border">
                        @foreach($product->specifications as $attribute)
                            <div class="grid grid-cols-2 border-b last:border-b-0">
                                <div class="bg-slate-50 px-4 py-3 font-bold">{{ $attribute->name }}</div>
                                <div class="px-4 py-3 text-slate-700">{{ $attribute->value }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="grid gap-5 md:grid-cols-3">
                <a href="{{ route('pages.delivery') }}"
                   class="rounded-3xl border bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="text-sm font-bold uppercase tracking-wide text-green-700">Delivery</div>
                    <h3 class="mt-2 font-black">Ask about transport</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        Share your delivery location and we can help review available options.
                    </p>
                </a>

                <a href="{{ route('pages.warranty') }}"
                   class="rounded-3xl border bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="text-sm font-bold uppercase tracking-wide text-green-700">Warranty</div>
                    <h3 class="mt-2 font-black">Confirm terms</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        Warranty and final sale terms must be confirmed before purchase.
                    </p>
                </a>

                <a href="{{ route('pages.service') }}"
                   class="rounded-3xl border bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="text-sm font-bold uppercase tracking-wide text-green-700">Service</div>
                    <h3 class="mt-2 font-black">Get support</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        Ask about maintenance, attachments or equipment-related questions.
                    </p>
                </a>
            </div>
        </div>

        <aside class="space-y-6">
            @if($canRequestQuote)
                <div id="quote" class="overflow-hidden rounded-3xl border bg-white shadow-sm">
                    <div class="border-b bg-slate-50 px-6 py-5">
                        <h2 class="text-2xl font-black">Request a quote</h2>
                        <p class="mt-2 text-sm leading-6 text-slate-600">
                            Leave your contact details and our team will contact you with pricing and availability.
                        </p>
                    </div>

                    <div class="p-6">
                        <div class="mb-5 space-y-4">
                            @include('front.components.form.alert')
                            @include('front.components.form.errors')
                        </div>

                        <form
                            action="{{ route('products.quote', $product) }}"
                            method="POST"
                            class="space-y-5"
                            data-ajax-form
                            data-success-message="Thank you! Your quote request has been sent successfully."
                        >
                            @csrf

                            <input
                                type="text"
                                name="website"
                                value=""
                                tabindex="-1"
                                autocomplete="off"
                                class="hidden"
                            >

                            @include('front.components.form.meta-tracking-fields')

                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            @include('front.components.form.input', [
                                'label' => 'Full name',
                                'name' => 'name',
                                'placeholder' => 'John Farmer',
                                'required' => true,
                            ])

                            @include('front.components.form.input', [
                                'label' => 'Phone number',
                                'name' => 'phone',
                                'placeholder' => '(304) 555-0123',
                                'required' => true,
                            ])

                            @include('front.components.form.input', [
                                'label' => 'Email address',
                                'name' => 'email',
                                'type' => 'email',
                                'placeholder' => 'john@example.com',
                            ])

                            @include('front.components.form.input', [
                                'label' => 'ZIP code',
                                'name' => 'zip_code',
                                'placeholder' => '26679',
                                'required' => true,
                            ])

                            @include('front.components.form.preferred-contact-method')

                            @include('front.components.form.textarea', [
                                'label' => 'Message',
                                'name' => 'message',
                                'rows' => 5,
                                'value' => 'I am interested in ' . $product->name . '.',
                            ])

                            @include('front.components.form.consent-checkbox')

                            <button
                                type="submit"
                                class="w-full rounded-2xl bg-green-700 px-5 py-3.5 text-sm font-black uppercase tracking-wide text-white shadow-lg shadow-green-900/20 transition hover:bg-green-800"
                            >
                                Send quote request
                            </button>

                            <p class="text-center text-xs leading-5 text-slate-500">
                                No payment required. This form only sends a request to {{ config('site.name') }}.
                            </p>
                        </form>
                    </div>
                </div>
            @else
                <div class="rounded-3xl border bg-white p-6 shadow-sm">
                    <h2 class="text-2xl font-black">Ask about this equipment</h2>

                    <p class="mt-3 text-sm leading-6 text-slate-600">
                        This listing is not currently available for direct quote requests. Contact us to confirm current
                        status or ask about similar equipment.
                    </p>

                    <div class="mt-5 grid gap-3">
                        <a href="{{ route('contact.index') }}"
                           class="rounded-2xl bg-green-700 px-5 py-3 text-center text-sm font-black text-white hover:bg-green-800">
                            Contact us
                        </a>

                        <a href="tel:{{ config('site.phone_tel') }}"
                           class="rounded-2xl border px-5 py-3 text-center text-sm font-black hover:bg-slate-50">
                            Call {{ config('site.phone') }}
                        </a>
                    </div>
                </div>
            @endif

            <div class="rounded-3xl bg-slate-900 p-6 text-white shadow-sm">
                <h2 class="text-xl font-black">Before you visit</h2>

                <p class="mt-3 text-sm leading-6 text-slate-300">
                    Please call or send a message to confirm current availability, price, condition and location before
                    visiting.
                </p>

                <div class="mt-5 rounded-2xl bg-white/10 p-4 text-sm leading-6 text-slate-200">
                    <div class="font-bold text-white">{{ config('site.name') }}</div>
                    @include('front.components.contact.address-link', [
                        'class' => 'mt-1 inline-block hover:text-green-700',
                    ])
                </div>

                <div class="mt-5 grid gap-3">
                    <a href="{{ route('contact.index') }}"
                       class="rounded-2xl bg-white px-5 py-3 text-center text-sm font-black text-slate-900 hover:bg-slate-100">
                        Contact us
                    </a>

                    <a href="{{ route('catalog.index') }}"
                       class="rounded-2xl border border-white/20 px-5 py-3 text-center text-sm font-black hover:bg-white/10">
                        View more inventory
                    </a>
                </div>
            </div>
        </aside>
    </section>

    @if($relatedProducts->isNotEmpty())
        <section class="mx-auto max-w-7xl px-4 py-10">
            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div>
                    <div class="text-sm font-bold uppercase tracking-wide text-green-700">More options</div>
                    <h2 class="mt-2 text-3xl font-black">Related equipment</h2>
                </div>

                <a href="{{ route('catalog.index') }}"
                   class="inline-flex rounded-2xl border bg-white px-5 py-3 text-sm font-bold hover:bg-slate-50">
                    View all inventory
                </a>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                @foreach($relatedProducts as $relatedProduct)
                    @include('front.components.product-card', ['product' => $relatedProduct])
                @endforeach
            </div>
        </section>
    @endif

    @push('meta_pixel_events')
        @if (config('services.meta.pixel_enabled') && config('services.meta.pixel_id'))
            @php
                $metaViewContentPayload = [
                    'content_ids' => $metaViewContentEvent['content_ids'],
                    'content_type' => $metaViewContentEvent['content_type'],
                    'content_name' => $metaViewContentEvent['content_name'],
                    'content_category' => $metaViewContentEvent['content_category'],
                    'value' => $metaViewContentEvent['value'],
                    'currency' => $metaViewContentEvent['currency'],
                ];

                $metaViewContentEventId = $metaViewContentEvent['event_id'];
            @endphp

            <script>
                if (typeof fbq === 'function') {
                    fbq('track', 'ViewContent', @json($metaViewContentPayload), {
                        eventID: @json($metaViewContentEventId)
                    });
                }
            </script>
        @endif
    @endpush
@endsection
