@if(session('success'))
    <div class="rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-800">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-medium text-red-800">
        {{ session('error') }}
    </div>
@endif
