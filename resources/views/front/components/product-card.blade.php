@props(['product'])

<a href="{{ route('products.show', $product) }}"
   class="group overflow-hidden rounded-2xl border bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
    <div class="aspect-[4/3] overflow-hidden bg-slate-100">
        <img
            src="{{ $product->main_image_url }}"
            alt="{{ $product->name }}"
            class="h-full w-full object-cover transition group-hover:scale-105"
        >
    </div>

    <div class="p-5">
        <div class="text-xs font-semibold uppercase tracking-wide text-green-700">
            {{ $product->category?->name }}
        </div>

        <h3 class="mt-2 line-clamp-2 text-lg font-bold text-slate-900">
            {{ $product->name }}
        </h3>

        <div class="mt-3 flex flex-wrap gap-2 text-xs text-slate-500">
            @if($product->brand)
                <span class="rounded-full bg-slate-100 px-2 py-1">{{ $product->brand->name }}</span>
            @endif

            @if($product->year)
                <span class="rounded-full bg-slate-100 px-2 py-1">{{ $product->year }}</span>
            @endif

            @if($product->condition)
                <span class="rounded-full bg-slate-100 px-2 py-1">{{ ucfirst($product->condition) }}</span>
            @endif
        </div>

        <div class="mt-4 flex items-center justify-between">
            <div class="text-xl font-bold text-green-700">
                {{ $product->formatted_price }}
            </div>

            <span class="text-sm font-semibold text-slate-700 group-hover:text-green-700">
                View details
            </span>
        </div>
    </div>
</a>
