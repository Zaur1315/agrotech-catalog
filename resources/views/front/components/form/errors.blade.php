@if($errors->any())
    <div class="rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800">
        <div class="font-bold">Please check the form fields:</div>

        <ul class="mt-2 list-inside list-disc space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
