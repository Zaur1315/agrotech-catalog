@extends('front.layouts.app', ['title' => 'Quote List'])

@section('content')
    @include('front.components.page-banner', [
        'title' => 'Quote List',
        'description' => 'Review selected equipment and send one request to our sales team.',
        'badge' => 'Quote List',
        'statLabel' => 'Selected items',
        'statValue' => $items->sum('quantity'),
    ])

    <section class="mx-auto grid max-w-7xl gap-10 px-4 py-10 lg:grid-cols-[1fr_420px]">
        <div>
            @if(session('success'))
                <div
                    class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            @if($items->isEmpty())
                <div class="rounded-2xl border bg-white p-10 text-center shadow-sm">
                    <h2 class="text-2xl font-bold">Your quote list is empty</h2>
                    <p class="mt-3 text-slate-600">
                        Add equipment from the catalog to request pricing and availability.
                    </p>

                    <a href="{{ route('catalog.index') }}"
                       class="mt-6 inline-flex rounded-xl bg-green-700 px-6 py-3 font-semibold text-white hover:bg-green-800">
                        Browse equipment
                    </a>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($items as $item)
                        @php
                            /** @var \App\Models\Product $product */
                            $product = $item['product'];
                        @endphp

                        <div class="flex gap-5 rounded-2xl border bg-white p-5 shadow-sm">
                            <img
                                src="{{ $product->main_image_url }}"
                                alt="{{ $product->name }}"
                                class="h-28 w-36 rounded-xl object-cover"
                            >

                            <div class="flex-1">
                                <div class="text-sm font-semibold text-green-700">
                                    {{ $product->category?->name }}
                                </div>

                                <a href="{{ route('products.show', $product) }}"
                                   class="mt-1 block text-xl font-bold hover:text-green-700">
                                    {{ $product->name }}
                                </a>

                                <div class="mt-2 text-sm text-slate-500">
                                    Quantity: {{ $item['quantity'] }}
                                </div>

                                <div class="mt-2 font-bold text-green-700">
                                    {{ $product->formatted_price }}
                                </div>
                            </div>

                            <form action="{{ route('quote.remove', $product) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="rounded-lg border px-4 py-2 text-sm font-semibold hover:bg-slate-100">
                                    Remove
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <aside class="overflow-hidden rounded-3xl border bg-white shadow-sm">
            <div class="border-b bg-slate-50 px-6 py-5">
                <h2 class="text-2xl font-bold">Send quote request</h2>
                <p class="mt-2 text-sm leading-6 text-slate-600">
                    Fill in your contact details and send one request for all selected equipment.
                </p>
            </div>

            <div class="p-6">
                <div class="mb-5 space-y-4">
                    @include('front.components.form.errors')
                </div>

                <form action="{{ route('quote.submit') }}" method="POST" class="space-y-5">
                    @csrf

                    @include('front.components.form.input', [
                        'label' => 'Full name',
                        'name' => 'name',
                        'placeholder' => 'John Farmer',
                        'required' => true,
                    ])

                    @include('front.components.form.input', [
                        'label' => 'Phone number',
                        'name' => 'phone',
                        'placeholder' => '+1 555 300 4000',
                        'required' => true,
                    ])

                    @include('front.components.form.input', [
                        'label' => 'Email address',
                        'name' => 'email',
                        'type' => 'email',
                        'placeholder' => 'john@example.com',
                    ])

                    @include('front.components.form.textarea', [
                        'label' => 'Message',
                        'name' => 'message',
                        'rows' => 5,
                        'placeholder' => 'Tell us more about your farm, delivery location or financing needs.',
                    ])

                    <button
                        type="submit"
                        class="w-full rounded-xl bg-green-700 px-5 py-3.5 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-green-900/20 transition hover:bg-green-800 disabled:cursor-not-allowed disabled:opacity-60"
                        @disabled($items->isEmpty())
                    >
                        Send request
                    </button>

                    @if($items->isEmpty())
                        <p class="text-center text-xs leading-5 text-slate-500">
                            Add at least one equipment item to enable this form.
                        </p>
                    @else
                        <p class="text-center text-xs leading-5 text-slate-500">
                            Selected equipment will be attached to this request.
                        </p>
                    @endif
                </form>
            </div>
        </aside>
    </section>
@endsection
