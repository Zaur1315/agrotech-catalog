@props(['product'])

@php
    $statusLabel = match ($product->status) {
        \App\Models\Product::STATUS_AVAILABLE => 'Available',
        \App\Models\Product::STATUS_PENDING => 'Pending',
        \App\Models\Product::STATUS_SOLD => 'Sold',
        \App\Models\Product::STATUS_HIDDEN => 'Hidden',
        default => null,
    };

    $statusClasses = match ($product->status) {
        \App\Models\Product::STATUS_AVAILABLE => 'bg-green-600 text-white',
        \App\Models\Product::STATUS_PENDING => 'bg-amber-500 text-white',
        \App\Models\Product::STATUS_SOLD => 'bg-slate-700 text-white',
        \App\Models\Product::STATUS_HIDDEN => 'bg-red-600 text-white',
        default => 'bg-slate-700 text-white',
    };

    $driveTypeLabel = match ($product->drive_type) {
        \App\Models\Product::DRIVE_TYPE_2WD => '2WD',
        \App\Models\Product::DRIVE_TYPE_4WD => '4WD',
        \App\Models\Product::DRIVE_TYPE_MFWD => 'MFWD',
        default => null,
    };

    $canRequestQuote = $product->status === \App\Models\Product::STATUS_AVAILABLE;
@endphp

<article
    class="group overflow-hidden rounded-3xl border bg-white shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-xl">
    <a href="{{ route('products.show', $product) }}" class="block">
        <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
            <img
                src="{{ $product->main_image_url }}"
                alt="{{ $product->name }}"
                class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
            >

            <div class="absolute left-4 top-4 flex flex-wrap gap-2">
                @if($statusLabel)
                    <span
                        class="rounded-full px-3 py-1 text-xs font-black uppercase tracking-wide shadow {{ $statusClasses }}">
                        {{ $statusLabel }}
                    </span>
                @endif

                @if($product->is_featured)
                    <span
                        class="rounded-full bg-white/95 px-3 py-1 text-xs font-black uppercase tracking-wide text-green-700 shadow">
                        Featured
                    </span>
                @endif
            </div>

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
            <div class="text-xs font-bold uppercase tracking-wide text-green-700">
                {{ $product->category?->name }}
            </div>

            @if($product->stock_number)
                <div class="shrink-0 rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-500">
                    Stock # {{ $product->stock_number }}
                </div>
            @elseif($product->sku)
                <div class="shrink-0 rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-500">
                    SKU {{ $product->sku }}
                </div>
            @endif
        </div>

        <a href="{{ route('products.show', $product) }}" class="mt-3 block">
            <h3 class="line-clamp-2 min-h-[3.5rem] text-lg font-black leading-7 text-slate-900 transition group-hover:text-green-700">
                {{ $product->name }}
            </h3>
        </a>

        <div class="mt-4 grid grid-cols-2 gap-2 text-xs text-slate-600">
            @if($product->brand)
                <div class="rounded-2xl bg-slate-50 px-3 py-2">
                    <div class="text-slate-400">Brand</div>
                    <div class="mt-1 line-clamp-1 font-bold text-slate-800">{{ $product->brand->name }}</div>
                </div>
            @endif

            @if($product->year)
                <div class="rounded-2xl bg-slate-50 px-3 py-2">
                    <div class="text-slate-400">Year</div>
                    <div class="mt-1 font-bold text-slate-800">{{ $product->year }}</div>
                </div>
            @endif

            @if($product->hours_used !== null)
                <div class="rounded-2xl bg-slate-50 px-3 py-2">
                    <div class="text-slate-400">Hours</div>
                    <div class="mt-1 font-bold text-slate-800">{{ number_format((int) $product->hours_used) }}</div>
                </div>
            @endif

            @if($product->horsepower)
                <div class="rounded-2xl bg-slate-50 px-3 py-2">
                    <div class="text-slate-400">Horsepower</div>
                    <div class="mt-1 font-bold text-slate-800">{{ $product->horsepower }} HP</div>
                </div>
            @endif

            @if($driveTypeLabel)
                <div class="rounded-2xl bg-slate-50 px-3 py-2">
                    <div class="text-slate-400">Drive</div>
                    <div class="mt-1 font-bold text-slate-800">{{ $driveTypeLabel }}</div>
                </div>
            @endif

            @if($product->location)
                <div class="rounded-2xl bg-slate-50 px-3 py-2">
                    <div class="text-slate-400">Location</div>
                    <div class="mt-1 line-clamp-1 font-bold text-slate-800">{{ $product->location }}</div>
                </div>
            @endif
        </div>

        <div class="mt-5 border-t pt-4">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <div class="text-xs font-semibold uppercase tracking-wide text-slate-400">Price</div>
                    <div class="text-2xl font-black text-green-700">
                        {{ $product->formatted_price }}
                    </div>
                </div>

                <a
                    href="{{ route('products.show', $product) }}"
                    class="rounded-2xl bg-slate-900 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-green-700"
                >
                    Details
                </a>
            </div>

            @if($canRequestQuote)
                <form action="{{ route('quote.add', $product) }}" method="POST" class="mt-3">
                    @csrf

                    <button
                        type="submit"
                        class="w-full rounded-2xl border border-slate-200 px-4 py-2.5 text-sm font-bold text-slate-800 transition hover:border-green-700 hover:bg-green-50 hover:text-green-700"
                    >
                        Add to quote list
                    </button>
                </form>
            @else
                <div class="mt-3 rounded-2xl bg-slate-100 px-4 py-2.5 text-center text-sm font-bold text-slate-500">
                    Contact us for availability
                </div>
            @endif
        </div>
    </div>
</article>
