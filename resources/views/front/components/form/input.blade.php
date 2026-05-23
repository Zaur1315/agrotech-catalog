@props([
    'label',
    'name',
    'type' => 'text',
    'placeholder' => null,
    'required' => false,
    'value' => null,
])

<div>
    <label for="{{ $name }}" class="mb-1.5 block text-sm font-semibold text-slate-800">
        {{ $label }}

        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    <input
        id="{{ $name }}"
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        @required($required)
        {{ $attributes->merge([
            'class' => 'block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-green-600 focus:ring-4 focus:ring-green-100'
        ]) }}
    >

    @error($name)
    <p class="mt-1.5 text-sm font-medium text-red-600">
        {{ $message }}
    </p>
    @enderror
</div>
