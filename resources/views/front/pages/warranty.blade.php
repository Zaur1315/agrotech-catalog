@extends('front.layouts.app', ['title' => 'Warranty & Equipment Terms'])

@section('content')
    @include('front.components.page-banner', [
        'title' => 'Warranty & Equipment Terms',
        'description' => 'Understand equipment condition, warranty availability, and purchase terms before you buy.',
        'badge' => 'Warranty',
    ])

    <section class="mx-auto max-w-7xl px-4 py-12">
        <div class="grid gap-8 lg:grid-cols-[1fr_380px]">
            <div class="space-y-8">
                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">
                        Clear information before you make a decision
                    </h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        {{ config('site.name') }} wants customers to understand what they are buying before they move
                        forward.
                        Equipment condition, warranty coverage, service history, included attachments, delivery terms,
                        and final sale
                        details can vary from one machine to another.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        Before purchasing any equipment, please contact us to confirm availability, current condition,
                        pricing,
                        included items, and whether any warranty or coverage applies to that specific unit.
                    </p>
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold">Used equipment condition</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">
                            Used equipment may show normal wear based on age, hours, prior use, and maintenance history.
                            Ask us for the latest condition details before purchase.
                        </p>
                    </div>

                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold">Warranty availability</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">
                            Warranty coverage is not automatically included unless it is clearly stated in writing for
                            the specific unit.
                            Some equipment may be sold as-is.
                        </p>
                    </div>

                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold">Confirm included items</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">
                            Attachments, implements, manuals, accessories, and transport arrangements should be
                            confirmed before finalizing a deal.
                        </p>
                    </div>

                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold">Written terms matter</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">
                            Final terms, price, delivery, warranty, and availability should be verified directly
                            with {{ config('site.name') }}
                            before purchase.
                        </p>
                    </div>
                </div>

                <div class="rounded-3xl border bg-amber-50 p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-amber-950">
                        Important note
                    </h2>

                    <p class="mt-4 leading-7 text-amber-900">
                        Website listings are provided for general information. Inventory, pricing, specifications,
                        hours,
                        attachments, condition, and availability may change. Please contact us directly to verify
                        details
                        before relying on any listing information.
                    </p>
                </div>

                <div class="rounded-3xl border bg-slate-50 p-6 md:p-8">
                    <h2 class="text-2xl font-bold">Have questions about a specific unit?</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        Send us the equipment link or stock information and we will help you review the details that
                        matter:
                        condition, price, warranty availability, attachments, delivery options, and next steps.
                    </p>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('catalog.index') }}"
                           class="rounded-xl bg-green-700 px-5 py-3 text-sm font-bold text-white hover:bg-green-800">
                            View inventory
                        </a>

                        <a href="{{ route('contact.index') }}"
                           class="rounded-xl border bg-white px-5 py-3 text-sm font-bold hover:bg-slate-100">
                            Ask a question
                        </a>
                    </div>
                </div>
            </div>

            <aside class="h-fit rounded-3xl bg-slate-900 p-6 text-white shadow-sm">
                <h2 class="text-xl font-bold">Verify before purchase</h2>

                <p class="mt-3 text-sm leading-6 text-slate-300">
                    Call or message us before making a decision. We can help confirm current equipment details and
                    available terms.
                </p>

                <div class="mt-6 space-y-3">
                    <a href="tel:{{ config('site.phone_tel') }}"
                       class="block rounded-xl bg-green-600 px-5 py-3 text-center text-sm font-bold hover:bg-green-700">
                        Call {{ config('site.phone') }}
                    </a>

                    <a href="{{ route('contact.index') }}"
                       class="block rounded-xl bg-white px-5 py-3 text-center text-sm font-bold text-slate-900 hover:bg-slate-100">
                        Contact us
                    </a>

                    <a href="{{ route('quote.index') }}"
                       class="block rounded-xl border border-white/20 px-5 py-3 text-center text-sm font-bold hover:bg-white/10">
                        Request a quote
                    </a>
                </div>

                <div class="mt-6 rounded-2xl bg-white/10 p-4 text-sm leading-6 text-slate-200">
                    <div class="font-bold text-white">Dealer</div>
                    <div class="mt-1">{{ config('site.name') }}</div>
                    @include('front.components.contact.address-link', [
                        'class' => 'mt-1 inline-block hover:text-green-700',
                    ])
                </div>
            </aside>
        </div>
    </section>
@endsection
