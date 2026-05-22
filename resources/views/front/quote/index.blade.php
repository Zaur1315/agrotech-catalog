@extends('front.layouts.app', ['title' => 'Quote List'])

@section('content')
    <section class="border-b bg-white">
        <div class="mx-auto max-w-7xl px-4 py-10">
            <div class="text-sm text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-green-700">Home</a>
                <span class="mx-2">/</span>
                <span>Quote List</span>
            </div>

            <h1 class="mt-4 text-4xl font-bold">Quote List</h1>
            <p class="mt-3 max-w-3xl text-slate-600">
                Review selected equipment and send one request to our sales team.
            </p>
        </div>
    </section>

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

        <aside class="rounded-2xl border bg-white p-6 shadow-sm">
            <h2 class="text-2xl font-bold">Send quote request</h2>
            <p class="mt-2 text-sm text-slate-600">
                Fill in your contact details and we will get back to you.
            </p>

            <form action="{{ route('quote.submit') }}" method="POST" class="mt-6 space-y-4">
                @csrf

                @if($errors->any())
                    <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                        <div class="font-semibold">Please check the form fields:</div>

                        <ul class="mt-2 list-inside list-disc">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    <label class="text-sm font-semibold">Name</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="mt-1 w-full rounded-lg border-slate-300"
                        required
                    >
                </div>

                <div>
                    <label class="text-sm font-semibold">Phone</label>
                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        class="mt-1 w-full rounded-lg border-slate-300"
                        required
                    >
                </div>

                <div>
                    <label class="text-sm font-semibold">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="mt-1 w-full rounded-lg border-slate-300"
                    >
                </div>

                <div>
                    <label class="text-sm font-semibold">Message</label>
                    <textarea
                        name="message"
                        rows="4"
                        class="mt-1 w-full rounded-lg border-slate-300"
                    >{{ old('message') }}</textarea>
                </div>

                <button
                    type="submit"
                    class="w-full rounded-xl bg-green-700 px-5 py-3 font-semibold text-white hover:bg-green-800 disabled:cursor-not-allowed disabled:opacity-60"
                    @disabled($items->isEmpty())
                >
                    Send request
                </button>
            </form>
        </aside>
    </section>
@endsection
