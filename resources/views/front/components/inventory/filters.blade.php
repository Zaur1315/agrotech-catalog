@php($prefix = $prefix ?? 'filter')

<form method="GET" action="{{ $currentCategory ? route('catalog.index') : request()->url() }}" class="filter-form">
    <div class="filter-form__field">
        <label for="{{ $prefix }}-search">Search inventory</label>
        <input id="{{ $prefix }}-search" class="inventory-input" type="search" name="search" value="{{ request('search') }}" placeholder="Search equipment">
    </div>

    <div class="filter-form__field">
        <label for="{{ $prefix }}-category">Category</label>
        <select id="{{ $prefix }}-category" class="inventory-input" name="category">
            <option value="">All categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category') == $category->id || $currentCategory?->id === $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="filter-form__field">
        <label for="{{ $prefix }}-brand">Manufacturer / Brand</label>
        <select id="{{ $prefix }}-brand" class="inventory-input" name="brand">
            <option value="">All brands</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}" @selected(request('brand') == $brand->id)>{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="filter-form__field">
        <label for="{{ $prefix }}-status">Availability</label>
        <select id="{{ $prefix }}-status" class="inventory-input" name="status">
            <option value="">Any public status</option>
            <option value="{{ \App\Models\Product::STATUS_AVAILABLE }}" @selected(request('status') === \App\Models\Product::STATUS_AVAILABLE)>Available</option>
            <option value="{{ \App\Models\Product::STATUS_PENDING }}" @selected(request('status') === \App\Models\Product::STATUS_PENDING)>Pending</option>
            <option value="{{ \App\Models\Product::STATUS_SOLD }}" @selected(request('status') === \App\Models\Product::STATUS_SOLD)>Sold</option>
        </select>
    </div>

    <div class="filter-form__field">
        <label for="{{ $prefix }}-condition">Condition</label>
        <select id="{{ $prefix }}-condition" class="inventory-input" name="condition">
            <option value="">Any condition</option>
            <option value="{{ \App\Models\Product::CONDITION_NEW }}" @selected(request('condition') === \App\Models\Product::CONDITION_NEW)>New</option>
            <option value="{{ \App\Models\Product::CONDITION_USED }}" @selected(request('condition') === \App\Models\Product::CONDITION_USED)>Used</option>
            <option value="{{ \App\Models\Product::CONDITION_REFURBISHED }}" @selected(request('condition') === \App\Models\Product::CONDITION_REFURBISHED)>Refurbished</option>
        </select>
    </div>

    <div class="filter-form__field">
        <label for="{{ $prefix }}-drive">Drive type</label>
        <select id="{{ $prefix }}-drive" class="inventory-input" name="drive_type">
            <option value="">Any drive type</option>
            <option value="{{ \App\Models\Product::DRIVE_TYPE_2WD }}" @selected(request('drive_type') === \App\Models\Product::DRIVE_TYPE_2WD)>2WD</option>
            <option value="{{ \App\Models\Product::DRIVE_TYPE_4WD }}" @selected(request('drive_type') === \App\Models\Product::DRIVE_TYPE_4WD)>4WD</option>
            <option value="{{ \App\Models\Product::DRIVE_TYPE_MFWD }}" @selected(request('drive_type') === \App\Models\Product::DRIVE_TYPE_MFWD)>MFWD</option>
        </select>
    </div>

    <fieldset class="filter-form__group">
        <legend>Price range (USD)</legend>
        <div class="filter-form__columns">
            <div class="filter-form__field"><label for="{{ $prefix }}-min-price">Minimum price</label><input id="{{ $prefix }}-min-price" class="inventory-input" type="number" min="0" name="min_price" value="{{ request('min_price') }}" placeholder="Min"></div>
            <div class="filter-form__field"><label for="{{ $prefix }}-max-price">Maximum price</label><input id="{{ $prefix }}-max-price" class="inventory-input" type="number" min="0" name="max_price" value="{{ request('max_price') }}" placeholder="Max"></div>
        </div>
    </fieldset>

    <fieldset class="filter-form__group">
        <legend>Model year</legend>
        <div class="filter-form__columns">
            <div class="filter-form__field"><label for="{{ $prefix }}-year-from">From</label><input id="{{ $prefix }}-year-from" class="inventory-input" type="number" min="1900" name="year_from" value="{{ request('year_from') }}" placeholder="From"></div>
            <div class="filter-form__field"><label for="{{ $prefix }}-year-to">To</label><input id="{{ $prefix }}-year-to" class="inventory-input" type="number" min="1900" name="year_to" value="{{ request('year_to') }}" placeholder="To"></div>
        </div>
    </fieldset>

    <div class="filter-form__columns">
        <div class="filter-form__field"><label for="{{ $prefix }}-hours">Max hours</label><input id="{{ $prefix }}-hours" class="inventory-input" type="number" min="0" name="max_hours" value="{{ request('max_hours') }}" placeholder="Hours"></div>
        <div class="filter-form__field"><label for="{{ $prefix }}-horsepower">Min HP</label><input id="{{ $prefix }}-horsepower" class="inventory-input" type="number" min="0" name="min_horsepower" value="{{ request('min_horsepower') }}" placeholder="HP"></div>
    </div>

    <div class="filter-form__actions">
        <button type="submit" class="btn-primary">Apply Filters</button>
        <a class="btn-outline" href="{{ $currentCategory ? route('catalog.category', $currentCategory) : route('catalog.index') }}">Clear All</a>
    </div>
</form>
