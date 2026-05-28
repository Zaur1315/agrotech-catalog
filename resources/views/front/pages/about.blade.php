@extends('front.layouts.app', ['title' => 'About Us'])

@section('content')
    @include('front.components.page-banner', [
        'title' => 'About ' . config('site.name'),
        'description' => 'A practical equipment dealership serving customers from Mt Nebo, West Virginia.',
        'badge' => 'About',
    ])

    <section class="mx-auto max-w-7xl px-4 py-12">
        <div class="grid gap-8 lg:grid-cols-[1fr_380px]">
            <div class="space-y-8">
                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">
                        Practical equipment. Clear communication. Local support.
                    </h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        {{ config('site.name') }} is an equipment dealership based in {{ config('site.city') }},
                        {{ config('site.state') }}. We help customers review available equipment, ask the right
                        questions,
                        request quotes, and understand practical details before making a purchase decision.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        Our focus is simple: provide useful equipment information, clear communication, and a
                        straightforward
                        buying process for customers looking for tractors, implements, attachments, mowers, trailers,
                        construction equipment, and other work-ready machines.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        Whether you are maintaining land, running a farm, handling property work, or looking for a
                        machine
                        for business use, our team can help you compare available inventory and request the information
                        you need.
                    </p>
                </div>

                <div class="grid gap-5 md:grid-cols-3">
                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <div class="text-3xl font-black text-green-700">01</div>
                        <h3 class="mt-4 text-lg font-bold">Inventory focused</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">
                            Browse equipment listings, review specs, and request more details before visiting or buying.
                        </p>
                    </div>

                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <div class="text-3xl font-black text-green-700">02</div>
                        <h3 class="mt-4 text-lg font-bold">Quote-first process</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">
                            Send a quote request for one machine or several items from your quote list.
                        </p>
                    </div>

                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <div class="text-3xl font-black text-green-700">03</div>
                        <h3 class="mt-4 text-lg font-bold">Straight answers</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">
                            Ask about condition, availability, delivery options, pricing, and purchase terms.
                        </p>
                    </div>
                </div>

                <div class="rounded-3xl border bg-slate-50 p-6 md:p-8">
                    <h2 class="text-2xl font-bold">
                        What we help with
                    </h2>

                    <div class="mt-6 grid gap-4 md:grid-cols-2">
                        <div class="rounded-2xl bg-white p-5">
                            <h3 class="font-bold">Equipment questions</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">
                                Ask about product details, specs, hours, condition, attachments, and availability.
                            </p>
                        </div>

                        <div class="rounded-2xl bg-white p-5">
                            <h3 class="font-bold">Quote requests</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">
                                Request pricing and availability for individual machines or a full quote list.
                            </p>
                        </div>

                        <div class="rounded-2xl bg-white p-5">
                            <h3 class="font-bold">Delivery questions</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">
                                Share your location and equipment interest so delivery options can be reviewed.
                            </p>
                        </div>

                        <div class="rounded-2xl bg-white p-5">
                            <h3 class="font-bold">Service-related support</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">
                                Contact us about maintenance questions, attachment fit, and practical equipment
                                guidance.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">
                        Visit or contact us
                    </h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        We are located at {{ config('site.address') }}. Before visiting, we recommend calling or sending
                        a
                        message to confirm equipment availability and the details of the unit you are interested in.
                    </p>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('catalog.index') }}"
                           class="rounded-xl bg-green-700 px-5 py-3 text-sm font-bold text-white hover:bg-green-800">
                            View inventory
                        </a>

                        <a href="{{ route('contact.index') }}"
                           class="rounded-xl border bg-white px-5 py-3 text-sm font-bold hover:bg-slate-100">
                            Contact us
                        </a>
                    </div>
                </div>
            </div>

            <aside class="h-fit rounded-3xl bg-slate-900 p-6 text-white shadow-sm">
                <h2 class="text-xl font-bold">{{ config('site.name') }}</h2>

                <p class="mt-3 text-sm leading-6 text-slate-300">
                    Equipment sales, quote requests, delivery questions, and practical support from our location in
                    {{ config('site.city') }}, {{ config('site.state') }}.
                </p>

                <div class="mt-6 space-y-4 text-sm">
                    <div class="rounded-2xl bg-white/10 p-4">
                        <div class="font-bold text-white">Phone</div>
                        <a href="tel:{{ config('site.phone_tel') }}"
                           class="mt-1 inline-block text-slate-200 hover:text-white">
                            {{ config('site.phone') }}
                        </a>
                    </div>

                    <div class="rounded-2xl bg-white/10 p-4">
                        <div class="font-bold text-white">Email</div>
                        <a href="mailto:{{ config('site.email') }}"
                           class="mt-1 inline-block text-slate-200 hover:text-white">
                            {{ config('site.email') }}
                        </a>
                    </div>

                    <div class="rounded-2xl bg-white/10 p-4">
                        <div class="font-bold text-white">Address</div>
                        <div class="mt-1 text-slate-200">
                            {{ config('site.address') }}
                        </div>
                    </div>
                </div>

                <div class="mt-6 space-y-3">
                    <a href="tel:{{ config('site.phone_tel') }}"
                       class="block rounded-xl bg-green-600 px-5 py-3 text-center text-sm font-bold hover:bg-green-700">
                        Call now
                    </a>

                    <a href="{{ route('quote.index') }}"
                       class="block rounded-xl bg-white px-5 py-3 text-center text-sm font-bold text-slate-900 hover:bg-slate-100">
                        Request a quote
                    </a>
                </div>
            </aside>
        </div>
    </section>
@endsection
