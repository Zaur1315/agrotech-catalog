@php
    $active = [];
    $baseUrl = request()->url();
    $queryWithoutPage = request()->except('page');

    if (request('search')) $active[] = ['key' => 'search', 'label' => 'Search: ' . request('search')];
    if ($currentCategory) $active[] = ['key' => 'category_route', 'label' => $currentCategory->name];
    if (request('category')) $active[] = ['key' => 'category', 'label' => optional($categories->firstWhere('id', (int) request('category')))->name ?? 'Category'];
    if (request('brand')) $active[] = ['key' => 'brand', 'label' => optional($brands->firstWhere('id', (int) request('brand')))->name ?? 'Brand'];
    if (request('status')) $active[] = ['key' => 'status', 'label' => ucfirst(request('status'))];
    if (request('condition')) $active[] = ['key' => 'condition', 'label' => ucfirst(request('condition'))];
    if (request('drive_type')) $active[] = ['key' => 'drive_type', 'label' => strtoupper(request('drive_type'))];
    if (request('min_price') || request('max_price')) $active[] = ['key' => 'price', 'label' => '$' . (request('min_price') ?: '0') . '–$' . (request('max_price') ?: 'Any')];
    if (request('year_from') || request('year_to')) $active[] = ['key' => 'year', 'label' => 'Year ' . (request('year_from') ?: 'Any') . '–' . (request('year_to') ?: 'Any')];
    if (request('max_hours')) $active[] = ['key' => 'max_hours', 'label' => 'Up to ' . request('max_hours') . ' hours'];
    if (request('min_horsepower')) $active[] = ['key' => 'min_horsepower', 'label' => request('min_horsepower') . '+ HP'];
@endphp

@if(count($active))
    <div class="active-filters" aria-label="Active filters">
        @foreach($active as $filter)
            @php
                $removeKeys = match ($filter['key']) {
                    'price' => ['min_price', 'max_price', 'page'],
                    'year' => ['year_from', 'year_to', 'page'],
                    'category_route' => ['category', 'page'],
                    default => [$filter['key'], 'page'],
                };
                $remaining = request()->except($removeKeys);
                $remove = $filter['key'] === 'category_route'
                    ? route('catalog.index', $remaining)
                    : $baseUrl . (count($remaining) ? '?' . http_build_query($remaining) : '');
            @endphp
            <a class="filter-chip" href="{{ $remove }}">{{ $filter['label'] }} <span aria-hidden="true">×</span><span class="sr-only"> remove filter</span></a>
        @endforeach
        <a class="filter-chip filter-chip--clear" href="{{ $currentCategory ? route('catalog.category', $currentCategory) : route('catalog.index') }}">Clear all</a>
    </div>
@endif
