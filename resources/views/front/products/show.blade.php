@extends('front.layouts.app', ['title' => $product->name])

@section('content')
    <section class="border-b bg-white">
        <div class="mx-auto max-w-7xl px-4 py-8">
            <div class="text-sm text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-green-700">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('catalog.index') }}" class="hover:text-green-700">Catalog</a>
                <span class="mx-2">/</span>
                <span>{{ $product->name }}</span>
            </div>
        </div>
    </section>
    @if(session('success'))
        <div class="mt-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mt-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-800">
            {{ session('error') }}
        </div>
    @endif

    <section class="mx-auto grid max-w-7xl gap-10 px-4 py-10 lg:grid-cols-2">
        <div>
            <div class="overflow-hidden rounded-3xl border bg-white shadow-sm">
                <img
                    src="{{ $product->main_image && ! str_starts_with($product->main_image, 'images/placeholders/')
                        ? asset('storage/' . $product->main_image)
                        : asset('images/placeholders/product-placeholder.jpg') }}"
                    alt="{{ $product->name }}"
                    class="aspect-[4/3] w-full object-cover"
                >
            </div>

            @if($product->images->isNotEmpty())
                <div class="mt-4 grid grid-cols-4 gap-3">
                    @foreach($product->images as $image)
                        <img
                            src="{{ asset('storage/' . $image->path) }}"
                            alt="{{ $image->alt ?? $product->name }}"
                            class="aspect-square rounded-xl border object-cover"
                        >
                    @endforeach
                </div>
            @endif
        </div>

        <div>
            <div class="text-sm font-semibold uppercase tracking-wide text-green-700">
                {{ $product->category?->name }}
            </div>

            <h1 class="mt-3 text-4xl font-bold">
                {{ $product->name }}
            </h1>

            <div class="mt-4 flex flex-wrap gap-2 text-sm text-slate-600">
                @if($product->brand)
                    <span class="rounded-full bg-slate-100 px-3 py-1">{{ $product->brand->name }}</span>
                @endif

                @if($product->year)
                    <span class="rounded-full bg-slate-100 px-3 py-1">{{ $product->year }}</span>
                @endif

                @if($product->condition)
                    <span class="rounded-full bg-slate-100 px-3 py-1">{{ ucfirst($product->condition) }}</span>
                @endif

                @if($product->sku)
                    <span class="rounded-full bg-slate-100 px-3 py-1">SKU: {{ $product->sku }}</span>
                @endif
            </div>

            <div class="mt-6 text-3xl font-bold text-green-700">
                {{ $product->formatted_price }}
            </div>

            @if($product->short_description)
                <p class="mt-5 text-lg text-slate-600">
                    {{ $product->short_description }}
                </p>
            @endif

            <div class="mt-8 flex flex-wrap gap-4">
                <a href="#quote" class="rounded-xl bg-green-700 px-6 py-3 font-semibold text-white hover:bg-green-800">
                    Request quote
                </a>

                <form action="{{ route('quote.add', $product) }}" method="POST">
                    @csrf

                    <button type="submit" class="rounded-xl border px-6 py-3 font-semibold hover:bg-slate-100">
                        Add to quote list
                    </button>
                </form>

                <a href="tel:+15553004000" class="rounded-xl border px-6 py-3 font-semibold hover:bg-slate-100">
                    Call dealer
                </a>
            </div>

            <div class="mt-8 grid gap-3 rounded-2xl border bg-white p-5">
                @if($product->engine)
                    <div class="flex justify-between border-b pb-2">
                        <span class="text-slate-500">Engine</span>
                        <span class="font-semibold">{{ $product->engine }}</span>
                    </div>
                @endif

                @if($product->transmission)
                    <div class="flex justify-between border-b pb-2">
                        <span class="text-slate-500">Transmission</span>
                        <span class="font-semibold">{{ $product->transmission }}</span>
                    </div>
                @endif

                @if($product->fuel_type)
                    <div class="flex justify-between border-b pb-2">
                        <span class="text-slate-500">Fuel type</span>
                        <span class="font-semibold">{{ $product->fuel_type }}</span>
                    </div>
                @endif

                @if($product->hours_used !== null)
                    <div class="flex justify-between">
                        <span class="text-slate-500">Hours used</span>
                        <span class="font-semibold">{{ $product->hours_used }}</span>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="mx-auto grid max-w-7xl gap-10 px-4 py-10 lg:grid-cols-[1fr_420px]">
        <div class="rounded-2xl border bg-white p-6 shadow-sm">
            <h2 class="text-2xl font-bold">Description</h2>

            <div class="prose mt-4 max-w-none">
                {!! $product->description !!}
            </div>

            @if($product->specifications->isNotEmpty())
                <h2 class="mt-10 text-2xl font-bold">Specifications</h2>

                <div class="mt-4 overflow-hidden rounded-xl border">
                    @foreach($product->specifications as $attribute)
                        <div class="grid grid-cols-2 border-b last:border-b-0">
                            <div class="bg-slate-50 px-4 py-3 font-semibold">{{ $attribute->name }}</div>
                            <div class="px-4 py-3">{{ $attribute->value }}</div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div id="quote" class="rounded-2xl border bg-white p-6 shadow-sm">
            <h2 class="text-2xl font-bold">Request a quote</h2>
            <p class="mt-2 text-sm text-slate-600">
                Leave your contact details and our sales team will contact you.
            </p>

            <form action="{{ route('products.quote', $product) }}" method="POST" class="mt-6 space-y-4">
                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div>
                    <label class="text-sm font-semibold">Name</label>
                    <input type="text" name="name" class="mt-1 w-full rounded-lg border-slate-300" required>
                </div>

                <div>
                    <label class="text-sm font-semibold">Phone</label>
                    <input type="text" name="phone" class="mt-1 w-full rounded-lg border-slate-300" required>
                </div>

                <div>
                    <label class="text-sm font-semibold">Email</label>
                    <input type="email" name="email" class="mt-1 w-full rounded-lg border-slate-300">
                </div>

                <div>
                    <label class="text-sm font-semibold">Message</label>
                    <textarea name="message" rows="4" class="mt-1 w-full rounded-lg border-slate-300">I am interested in {{ $product->name }}.</textarea>
                </div>

                <button type="submit"
                        class="w-full rounded-xl bg-green-700 px-5 py-3 font-semibold text-white hover:bg-green-800">
                    Send request
                </button>
            </form>
        </div>
    </section>

    @if($relatedProducts->isNotEmpty())
        <section class="mx-auto max-w-7xl px-4 py-10">
            <h2 class="text-3xl font-bold">Related equipment</h2>

            <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                @foreach($relatedProducts as $relatedProduct)
                    @include('front.components.product-card', ['product' => $relatedProduct])
                @endforeach
            </div>
        </section>
    @endif
@endsection
