@php
    $fieldName = $name ?? 'consent_accepted';
@endphp

<label class="flex gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm leading-6 text-slate-700">
    <input
        type="checkbox"
        name="{{ $fieldName }}"
        value="1"
        @checked(old($fieldName))
        required
        class="mt-1 h-4 w-4 rounded border-slate-300 text-green-700 focus:ring-green-700"
    >

    <span>
        I agree to be contacted by {{ config('site.name') }} about this request by phone, email, or text message.
        I understand that submitting this form does not create a purchase agreement.
    </span>
</label>
