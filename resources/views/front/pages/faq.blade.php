@extends('front.layouts.app', ['title' => 'FAQ'])

@section('content')
    @include('front.components.page-banner', [
        'title' => 'Frequently Asked Questions',
        'description' => 'Answers to common questions about equipment availability, quotes, delivery, warranty and visiting our location.',
        'badge' => 'FAQ',
    ])

    <section class="mx-auto max-w-7xl px-4 py-12">
        <div class="grid gap-8 lg:grid-cols-[1fr_380px]">
            <div class="space-y-5">
                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Common questions</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        If you are interested in a machine listed on our website, we recommend contacting
                        {{ config('site.name') }} before visiting. Availability, pricing, condition, attachments,
                        delivery options and purchase terms should be confirmed directly with our team.
                    </p>
                </div>

                <div class="space-y-4">
                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold">Can I request a quote online?</h3>
                        <p class="mt-3 leading-7 text-slate-600">
                            Yes. You can request a quote from an individual equipment page or add multiple items
                            to your quote list and send one request. A team member will review your request and
                            contact you using the contact information you provide.
                        </p>
                    </div>

                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold">Is equipment availability guaranteed?</h3>
                        <p class="mt-3 leading-7 text-slate-600">
                            Website inventory is provided for general information and may change. Equipment can be
                            sold, reserved, moved, or updated before the website listing changes. Please contact us
                            to confirm current availability before making plans or visiting.
                        </p>
                    </div>

                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold">Do you offer delivery?</h3>
                        <p class="mt-3 leading-7 text-slate-600">
                            Delivery options may be available depending on the equipment type, distance, timing and
                            transport requirements. Send us the equipment link and your delivery location so we can
                            help review available options.
                        </p>
                    </div>

                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold">Does used equipment include a warranty?</h3>
                        <p class="mt-3 leading-7 text-slate-600">
                            Warranty or coverage depends on the specific machine and must be confirmed in writing.
                            Some used equipment may be sold as-is. Please ask about warranty availability before
                            finalizing a purchase.
                        </p>
                    </div>

                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold">Can I ask about financing?</h3>
                        <p class="mt-3 leading-7 text-slate-600">
                            You may contact us with financing-related questions. Any financing availability, terms,
                            approval, rates, payments or third-party requirements must be confirmed before purchase.
                        </p>
                    </div>

                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold">Should I call before visiting?</h3>
                        <p class="mt-3 leading-7 text-slate-600">
                            Yes. We recommend calling or sending a message before visiting {{ config('site.address') }}.
                            This helps confirm that the equipment you want to see is still available and ready to
                            review.
                        </p>
                    </div>

                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold">Can I ask about attachments or compatibility?</h3>
                        <p class="mt-3 leading-7 text-slate-600">
                            Yes. If you are looking for a loader, mower, implement, trailer, or attachment, send us
                            your equipment details and the type of work you need to do. We will help review practical
                            fit and availability.
                        </p>
                    </div>
                </div>
            </div>

            <aside class="h-fit rounded-3xl bg-slate-900 p-6 text-white shadow-sm">
                <h2 class="text-xl font-bold">Still have questions?</h2>

                <p class="mt-3 text-sm leading-6 text-slate-300">
                    Contact {{ config('site.name') }} and tell us what equipment you are interested in. We will help
                    review availability, condition, delivery options and next steps.
                </p>

                <div class="mt-6 space-y-3">
                    <a href="tel:{{ config('site.phone_tel') }}"
                       class="block rounded-xl bg-green-600 px-5 py-3 text-center text-sm font-bold hover:bg-green-700">
                        Call {{ config('site.phone') }}
                    </a>

                    <a href="{{ route('contact.index') }}"
                       class="block rounded-xl bg-white px-5 py-3 text-center text-sm font-bold text-slate-900 hover:bg-slate-100">
                        Send a message
                    </a>

                    <a href="{{ route('catalog.index') }}"
                       class="block rounded-xl border border-white/20 px-5 py-3 text-center text-sm font-bold hover:bg-white/10">
                        View inventory
                    </a>
                </div>

                <div class="mt-6 rounded-2xl bg-white/10 p-4 text-sm leading-6 text-slate-200">
                    <div class="font-bold text-white">Location</div>
                    <div class="mt-1">{{ config('site.address') }}</div>
                </div>
            </aside>
        </div>
    </section>
@endsection
