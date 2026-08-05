@extends('front.layouts.app', ['title' => 'Farm & Construction Equipment'])

@section('content')
    <section class="relative overflow-hidden bg-brand-900 text-white">
        <div class="absolute inset-0 bg-gradient-to-br from-brand-800 via-brand-900 to-slate-950"></div>
        <div class="absolute -right-24 top-20 h-72 w-72 rounded-full bg-brand-500/20 blur-3xl"></div>
        <div class="absolute -left-24 bottom-10 h-72 w-72 rounded-full bg-amber-700/20 blur-3xl"></div>

        <div
            class="relative mx-auto grid max-w-7xl items-center gap-12 px-4 py-16 lg:grid-cols-[1.05fr_0.95fr] lg:py-24">
            <div>
                <div
                    class="mb-5 inline-flex rounded-full border border-brand-500/40 bg-brand-500/10 px-4 py-2 text-sm font-semibold text-amber-200">
                    Middle Tennessee equipment dealer · Since 1997
                </div>

                <h1 class="max-w-3xl text-4xl font-extrabold tracking-tight md:text-6xl">
                    Equipment that earns its keep.
                </h1>

                <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300">
                    From tractors and skid steers to hay tools and loaders, Moore’s Farm Equipment helps farmers,
                    landowners and contractors find capable machines without the runaround.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('catalog.index') }}"
                       class="rounded-2xl bg-brand-500 px-6 py-3.5 font-bold text-brand-900 shadow-lg shadow-black/20 transition hover:bg-amber-300">
                        Shop equipment
                    </a>

                    <a href="tel:{{ config('site.phone_tel') }}"
                       class="rounded-2xl border border-white/20 px-6 py-3.5 font-bold text-white transition hover:border-brand-500 hover:bg-white/10">
                        Call {{ config('site.phone') }}
                    </a>

                    <a href="{{ route('quote.index') }}"
                       class="rounded-2xl border border-white/20 px-6 py-3.5 font-bold text-white transition hover:border-brand-500 hover:bg-white/10">
                        Build a quote
                    </a>
                </div>

                <div class="mt-6 grid max-w-3xl grid-cols-1 gap-4 sm:grid-cols-3">
                    <div class="rounded-3xl border border-white/10 bg-white/5 p-5">
                        <div class="text-3xl font-black">{{ $availableProductsCount }}</div>
                        <div class="mt-1 text-sm leading-5 text-slate-300">Available equipment listings</div>
                    </div>

                    <div class="rounded-3xl border border-white/10 bg-white/5 p-5">
                        <div class="text-3xl font-black">1–2</div>
                        <div class="mt-1 text-sm leading-5 text-slate-300">Steps to call or request a quote</div>
                    </div>

                    <div class="rounded-3xl border border-white/10 bg-white/5 p-5">
                        <div class="text-3xl font-black">TN</div>
                        <div class="mt-1 text-sm leading-5 text-slate-300">Serving Gallatin & Middle Tennessee</div>
                    </div>
                </div>

                <div class="mt-6 flex flex-col gap-3 text-sm text-slate-300 sm:flex-row sm:flex-wrap sm:items-center">
                    <a href="{{ config('site.maps_url') }}"
                       target="_blank"
                       rel="noopener"
                       class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/5 px-4 py-3 font-semibold transition hover:border-brand-500 hover:text-white">
                        <span>📍</span>
                        <span>{{ config('site.address') }}</span>
                    </a>

                    <a href="mailto:{{ config('site.email') }}"
                       target="_blank"
                       class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/5 px-4 py-3 font-semibold transition hover:border-brand-500 hover:text-white">
                        <span>✉</span>
                        <span>{{ config('site.email') }}</span>
                    </a>
                </div>
            </div>

            <div class="relative">
                @php
                    $heroProduct = $featuredProducts->first() ?? $latestProducts->first();
                @endphp

                @if($heroProduct)
                    <div
                        class="overflow-hidden rounded-[2rem] border border-white/10 bg-white/10 p-4 shadow-2xl shadow-slate-950/50">
                        <img
                            src="{{ $heroProduct->main_image_url }}"
                            alt="{{ $heroProduct->name }}"
                            class="aspect-[4/3] w-full rounded-[1.5rem] object-cover"
                        >

                        <div class="mt-4 rounded-3xl bg-white p-5 text-slate-900">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <div class="text-sm font-bold uppercase tracking-wide text-green-700">
                                    Featured inventory
                                </div>

                                @if($heroProduct->stock_number)
                                    <div class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">
                                        Stock # {{ $heroProduct->stock_number }}
                                    </div>
                                @endif
                            </div>

                            <div class="mt-2 text-2xl font-black">
                                {{ $heroProduct->name }}
                            </div>

                            <div class="mt-3 flex flex-wrap gap-2 text-sm text-slate-600">
                                @if($heroProduct->brand)
                                    <span
                                        class="rounded-full bg-slate-100 px-3 py-1">{{ $heroProduct->brand->name }}</span>
                                @endif

                                @if($heroProduct->year)
                                    <span class="rounded-full bg-slate-100 px-3 py-1">{{ $heroProduct->year }}</span>
                                @endif

                                @if($heroProduct->hours_used !== null)
                                    <span
                                        class="rounded-full bg-slate-100 px-3 py-1">{{ $heroProduct->hours_used }} hrs</span>
                                @endif

                                @if($heroProduct->horsepower)
                                    <span
                                        class="rounded-full bg-slate-100 px-3 py-1">{{ $heroProduct->horsepower }} HP</span>
                                @endif
                            </div>

                            <div class="mt-5 flex flex-wrap items-center justify-between gap-4">
                                <div>
                                    <div class="text-xs font-semibold uppercase tracking-wide text-slate-400">Price
                                    </div>
                                    <div class="text-2xl font-black text-green-700">
                                        {{ $heroProduct->formatted_price }}
                                    </div>
                                </div>

                                <a href="{{ route('products.show', $heroProduct) }}"
                                   class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-green-700">
                                    View details
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="rounded-[2rem] border border-white/10 bg-white/10 p-8 shadow-2xl">
                        <h2 class="text-2xl font-bold">Inventory coming soon</h2>
                        <p class="mt-3 leading-7 text-slate-300">
                            Contact {{ config('site.name') }} to ask about current equipment availability.
                        </p>

                        <a href="{{ route('contact.index') }}"
                           class="mt-6 inline-flex rounded-2xl bg-green-600 px-5 py-3 text-sm font-bold text-white hover:bg-green-700">
                            Contact us
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14">
        <div class="grid gap-5 md:grid-cols-3">
            <div class="rounded-3xl border bg-white p-6 shadow-sm">
                <div class="text-lg font-bold">Inventory you can ask about</div>
                <p class="mt-3 text-sm leading-6 text-slate-600">
                    Review equipment listings, specs, photos and pricing details, then contact us to confirm current
                    availability.
                </p>
            </div>

            <div class="rounded-3xl border bg-white p-6 shadow-sm">
                <div class="text-lg font-bold">Quote-first buying process</div>
                <p class="mt-3 text-sm leading-6 text-slate-600">
                    Request a quote for one machine or add several items to your quote list and send one combined
                    request.
                </p>
            </div>

            <div class="rounded-3xl border bg-white p-6 shadow-sm">
                <div class="text-lg font-bold">Delivery and support questions</div>
                <p class="mt-3 text-sm leading-6 text-slate-600">
                    Ask about delivery options, equipment condition, attachments, warranty availability and next steps.
                </p>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <div class="text-sm font-bold uppercase tracking-wide text-green-700">Shop by type</div>
                <h2 class="mt-2 text-3xl font-black">Equipment categories</h2>
                <p class="mt-2 max-w-2xl text-slate-600">
                    Find equipment by the type of work you need to complete.
                </p>
            </div>

            <a href="{{ route('catalog.index') }}"
               class="inline-flex rounded-2xl border bg-white px-5 py-3 text-sm font-bold hover:bg-slate-50">
                View all inventory
            </a>
        </div>

        <div class="mt-8 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
            @foreach($categories as $category)
                <a
                    href="{{ route('catalog.category', $category) }}"
                    class="group relative overflow-hidden rounded-3xl border border-slate-800 bg-slate-950 p-6 text-white shadow-xl transition duration-200 hover:-translate-y-1 hover:border-green-500 hover:shadow-2xl"
                >
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-green-900/50 via-slate-950 to-slate-950 opacity-90"></div>
                    <div
                        class="absolute -right-10 -top-10 h-28 w-28 rounded-full bg-green-500/20 blur-2xl transition group-hover:bg-green-400/30"></div>

                    <div class="relative">
                        <div
                            class="mb-4 inline-flex rounded-full border border-white/10 bg-white/10 px-3 py-1 text-xs font-bold uppercase tracking-wide text-green-200">
                            Inventory
                        </div>

                        <div class="text-xl font-black text-white transition group-hover:text-green-200">
                            {{ $category->name }}
                        </div>

                        @if($category->description)
                            <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-300">
                                {{ $category->description }}
                            </p>
                        @endif

                        <div
                            class="mt-5 inline-flex items-center text-sm font-bold text-green-300 transition group-hover:text-green-200">
                            Browse category
                            <span class="ml-2 transition group-hover:translate-x-1">→</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <section class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-14">
            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div>
                    <div class="text-sm font-bold uppercase tracking-wide text-green-700">Featured inventory</div>
                    <h2 class="mt-2 text-3xl font-black">Selected equipment</h2>
                    <p class="mt-2 max-w-2xl text-slate-600">
                        Review available equipment and request pricing, condition details or delivery information.
                    </p>
                </div>

                <a href="{{ route('catalog.index') }}"
                   class="inline-flex rounded-2xl border px-5 py-3 text-sm font-bold hover:bg-slate-50">
                    Browse inventory
                </a>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse($featuredProducts as $product)
                    @include('front.components.product-card', ['product' => $product])
                @empty
                    <div class="rounded-3xl border bg-slate-50 p-8">
                        <h3 class="text-xl font-bold">No featured equipment yet</h3>
                        <p class="mt-3 text-slate-600">
                            Contact us to ask about current inventory and upcoming equipment.
                        </p>

                        <a href="{{ route('contact.index') }}"
                           class="mt-5 inline-flex rounded-2xl bg-green-700 px-5 py-3 text-sm font-bold text-white hover:bg-green-800">
                            Contact us
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14">
        <div class="grid gap-6 md:grid-cols-3">
            <a href="{{ route('pages.service') }}"
               class="rounded-3xl border bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                <div class="text-sm font-bold uppercase tracking-wide text-green-700">Service</div>
                <h3 class="mt-3 text-xl font-black">Equipment support</h3>
                <p class="mt-3 text-sm leading-6 text-slate-600">
                    Ask about maintenance, attachments, equipment condition and practical support before or after
                    purchase.
                </p>
            </a>

            <a href="{{ route('pages.delivery') }}"
               class="rounded-3xl border bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                <div class="text-sm font-bold uppercase tracking-wide text-green-700">Delivery</div>
                <h3 class="mt-3 text-xl font-black">Transport questions</h3>
                <p class="mt-3 text-sm leading-6 text-slate-600">
                    Share your delivery location and equipment interest so available delivery options can be reviewed.
                </p>
            </a>

            <a href="{{ route('pages.warranty') }}"
               class="rounded-3xl border bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                <div class="text-sm font-bold uppercase tracking-wide text-green-700">Warranty</div>
                <h3 class="mt-3 text-xl font-black">Verify terms</h3>
                <p class="mt-3 text-sm leading-6 text-slate-600">
                    Confirm warranty availability, condition notes, included items and final terms before purchase.
                </p>
            </a>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14">
        <div class="overflow-hidden rounded-[2rem] bg-slate-900 text-white shadow-xl">
            <div class="grid gap-8 p-8 md:grid-cols-[1fr_360px] md:p-12">
                <div>
                    <div class="text-sm font-bold uppercase tracking-wide text-green-300">How quotes work</div>
                    <h2 class="mt-3 text-3xl font-black">Request pricing and availability without pressure.</h2>
                    <p class="mt-4 max-w-2xl leading-7 text-slate-300">
                        Choose a machine, send a quote request, or build a quote list with multiple items. We will
                        review
                        your request and help confirm current availability, pricing, condition and next steps.
                    </p>
                </div>

                <div class="space-y-3">
                    <a href="{{ route('quote.index') }}"
                       class="block rounded-2xl bg-green-600 px-6 py-3.5 text-center text-sm font-black text-white hover:bg-green-700">
                        Open quote list
                    </a>

                    <a href="{{ route('contact.index') }}"
                       class="block rounded-2xl bg-white px-6 py-3.5 text-center text-sm font-black text-slate-900 hover:bg-slate-100">
                        Contact us
                    </a>

                    <a href="tel:{{ config('site.phone_tel') }}"
                       class="block rounded-2xl border border-white/20 px-6 py-3.5 text-center text-sm font-black text-white hover:bg-white/10">
                        Call {{ config('site.phone') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <div class="text-sm font-bold uppercase tracking-wide text-green-700">Recently added</div>
                <h2 class="mt-2 text-3xl font-black">Latest inventory</h2>
                <p class="mt-2 max-w-2xl text-slate-600">
                    Recently added equipment listings from {{ config('site.name') }}.
                </p>
            </div>

            <a href="{{ route('catalog.index') }}"
               class="inline-flex rounded-2xl border bg-white px-5 py-3 text-sm font-bold hover:bg-slate-50">
                View all inventory
            </a>
        </div>

        <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($latestProducts as $product)
                @include('front.components.product-card', ['product' => $product])
            @empty
                <div class="rounded-3xl border bg-white p-8 shadow-sm">
                    <h3 class="text-xl font-bold">No inventory listed yet</h3>
                    <p class="mt-3 text-slate-600">
                        Contact {{ config('site.name') }} to ask about available equipment.
                    </p>
                </div>
            @endforelse
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14">
        <div class="grid gap-8 rounded-[2rem] border bg-white p-8 shadow-sm md:grid-cols-[1fr_360px] md:p-10">
            <div>
                <div class="text-sm font-bold uppercase tracking-wide text-green-700">Visit or contact</div>
                <h2 class="mt-3 text-3xl font-black">{{ config('site.name') }}</h2>

                <p class="mt-4 max-w-2xl leading-7 text-slate-600">
                    We are located at
                    <a href="{{ config('site.maps_url') }}" target="_blank" rel="noopener"
                       class="font-bold text-green-700 hover:text-green-800">
                        {{ config('site.address') }}
                    </a>.
                    Before visiting, call or send a message to confirm
                </p>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('contact.index') }}"
                       class="rounded-2xl bg-green-700 px-5 py-3 text-sm font-bold text-white hover:bg-green-800">
                        Contact us
                    </a>

                    <a href="{{ route('catalog.index') }}"
                       class="rounded-2xl border bg-white px-5 py-3 text-sm font-bold hover:bg-slate-50">
                        View inventory
                    </a>
                </div>
            </div>

            <div class="rounded-3xl bg-slate-50 p-6">
                <div class="space-y-4 text-sm text-slate-700">
                    <div>
                        <div class="font-bold text-slate-950">Phone</div>
                        <a href="tel:{{ config('site.phone_tel') }}" class="mt-1 inline-block hover:text-green-700">
                            {{ config('site.phone') }}
                        </a>
                    </div>

                    <div>
                        <div class="font-bold text-slate-950">Email</div>
                        <a href="mailto:{{ config('site.email') }}" class="mt-1 inline-block hover:text-green-700">
                            {{ config('site.email') }}
                        </a>
                    </div>

                    <div>
                        <div class="font-bold text-slate-950">Address</div>
                        <a href="{{ config('site.maps_url') }}"
                           target="_blank"
                           rel="noopener"
                           class="mt-1 inline-block hover:text-green-700">
                            {{ config('site.address') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
