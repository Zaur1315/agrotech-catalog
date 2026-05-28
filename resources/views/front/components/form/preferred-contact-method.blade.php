@php
    $fieldName = $name ?? 'preferred_contact_method';
    $fieldLabel = $label ?? 'Preferred contact method';
    $selectedValue = old($fieldName, $value ?? 'any');
@endphp

<div>
    <label for="{{ $fieldName }}" class="mb-2 block text-sm font-semibold text-slate-900">
        {{ $fieldLabel }}
    </label>

    <select
        id="{{ $fieldName }}"
        name="{{ $fieldName }}"
        class="w-full rounded-xl border border-slate-300 shadow-sm bg-white px-4 py-3 text-sm outline-none transition focus:border-green-700 focus:ring-4 focus:ring-green-700/10"
    >
        <option value="any" @selected($selectedValue === 'any')>
            Any
        </option>

        <option value="phone" @selected($selectedValue === 'phone')>
            Phone
        </option>

        <option value="email" @selected($selectedValue === 'email')>
            Email
        </option>
    </select>
</div>
