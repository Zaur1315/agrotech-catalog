@php
    $summary = array_filter([
        'Year' => $product->year,
        'Manufacturer' => $product->brand?->name,
        'Condition' => $product->condition ? ucfirst($product->condition) : null,
        'Hours' => $product->hours_used !== null ? number_format((int) $product->hours_used) : null,
        'Horsepower' => $product->horsepower ? $product->horsepower . ' HP' : null,
        'Category' => $product->category?->name,
    ], fn ($value) => $value !== null && $value !== '');
@endphp

@if(count($summary))
    <dl class="spec-list spec-list--summary">
        @foreach($summary as $label => $value)<div><dt>{{ $label }}</dt><dd>{{ $value }}</dd></div>@endforeach
    </dl>
@endif
