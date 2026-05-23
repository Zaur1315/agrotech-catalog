@props(['product'])

<article
    class="group overflow-hidden rounded-2xl border bg-white shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-xl">
    <a href="{{ route('products.show', $product) }}" class="block">
        <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
            <img
                src="{{ $product->main_image_url }}"
                alt="{{ $product->name }}"
                class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
            >

            @if($product->is_featured)
                <div
                    class="absolute left-4 top-4 rounded-full bg-green-600 px-3 py-1 text-xs font-bold uppercase tracking-wide text-white shadow">
                    Featured
                </div>
            @endif

            @if($product->condition)
                <div
                    class="absolute right-4 top-4 rounded-full bg-white/95 px-3 py-1 text-xs font-bold uppercase tracking-wide text-slate-800 shadow">
                    {{ ucfirst($product->condition) }}
                </div>
            @endif
        </div>
    </a>

    <div class="p-5">
        <div class="flex items-center justify-between gap-3">
            <div class="text-xs font-semibold uppercase tracking-wide text-green-700">
                {{ $product->category?->name }}
            </div>

            @if($product->sku)
                <div class="text-xs text-slate-400">
                    {{ $product->sku }}
                </div>
            @endif
        </div>

        <a href="{{ route('products.show', $product) }}" class="mt-2 block">
            <h3 class="line-clamp-2 min-h-[3.5rem] text-lg font-bold leading-7 text-slate-900 group-hover:text-green-700">
                {{ $product->name }}
            </h3>
        </a>

        <div class="mt-4 grid grid-cols-2 gap-2 text-xs text-slate-600">
            @if($product->brand)
                <div class="rounded-xl bg-slate-50 px-3 py-2">
                    <div class="text-slate-400">Brand</div>
                    <div class="mt-1 font-semibold text-slate-800">{{ $product->brand->name }}</div>
                </div>
            @endif

            @if($product->year)
                <div class="rounded-xl bg-slate-50 px-3 py-2">
                    <div class="text-slate-400">Year</div>
                    <div class="mt-1 font-semibold text-slate-800">{{ $product->year }}</div>
                </div>
            @endif

            @if($product->engine)
                <div class="rounded-xl bg-slate-50 px-3 py-2">
                    <div class="text-slate-400">Engine</div>
                    <div class="mt-1 line-clamp-1 font-semibold text-slate-800">{{ $product->engine }}</div>
                </div>
            @endif

            @if($product->hours_used !== null)
                <div class="rounded-xl bg-slate-50 px-3 py-2">
                    <div class="text-slate-400">Hours</div>
                    <div class="mt-1 font-semibold text-slate-800">{{ $product->hours_used }}</div>
                </div>
            @endif
        </div>

        <div class="mt-5 flex items-center justify-between border-t pt-4">
            <div>
                <div class="text-xs text-slate-400">Price</div>
                <div class="text-xl font-bold text-green-700">
                    {{ $product->formatted_price }}
                </div>
            </div>

            <a href="{{ route('products.show', $product) }}"
               class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700">
                Details
            </a>
        </div>

        <form action="{{ route('quote.add', $product) }}" method="POST" class="mt-3">
            @csrf

            <button type="submit"
                    class="w-full rounded-xl border px-4 py-2 text-sm font-semibold text-slate-800 hover:border-green-700 hover:bg-green-50 hover:text-green-700">
                Add to quote list
            </button>
        </form>
    </div>
</article>
