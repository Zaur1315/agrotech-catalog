@extends('front.layouts.app', ['title' => 'Delivery Options'])

@section('content')
    @include('front.components.page-banner', [
        'title' => 'Equipment Delivery Options',
        'description' => 'Ask about local and regional equipment delivery options before you buy.',
        'badge' => 'Delivery',
    ])

    <section class="mx-auto max-w-7xl px-4 py-12">
        <div class="grid gap-8 lg:grid-cols-[1fr_380px]">
            <div class="space-y-8">
                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">
                        Help getting your equipment where it needs to go
                    </h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        Buying equipment is only one part of the process. You also need a practical way to move it
                        from the dealer location to your farm, property, job site, or
                        business. {{ config('site.name') }}
                        can help you discuss available delivery options before you complete your purchase.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        Delivery availability depends on the equipment type, size, distance, timing, and current
                        logistics.
                        Contact us with the machine you are interested in and the delivery location, and we will help
                        review
                        the next available option.
                    </p>
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold">Local delivery questions</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">
                            If you are near {{ config('site.city') }}, {{ config('site.state') }}, contact us to ask
                            about
                            local delivery availability and scheduling.
                        </p>
                    </div>

                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold">Regional transport</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">
                            For larger equipment or longer distances, we can discuss practical transport options and
                            what
                            information is needed before quoting delivery.
                        </p>
                    </div>

                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold">Equipment size matters</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">
                            Tractors, attachments, mowers, trailers, and implements may require different loading and
                            transport
                            arrangements.
                        </p>
                    </div>

                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold">Confirm before purchase</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">
                            Delivery terms, cost, timing, and availability should be confirmed in writing before
                            finalizing
                            the sale.
                        </p>
                    </div>
                </div>

                <div class="rounded-3xl border bg-slate-50 p-6 md:p-8">
                    <h2 class="text-2xl font-bold">Request delivery information</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        To help us review delivery options, include the equipment name, your city and state, preferred
                        timing,
                        and any access details such as driveway, loading area, gate width, or job site restrictions.
                    </p>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('contact.index') }}"
                           class="rounded-xl bg-green-700 px-5 py-3 text-sm font-bold text-white hover:bg-green-800">
                            Ask about delivery
                        </a>

                        <a href="{{ route('catalog.index') }}"
                           class="rounded-xl border bg-white px-5 py-3 text-sm font-bold hover:bg-slate-100">
                            View inventory
                        </a>
                    </div>
                </div>
            </div>

            <aside class="h-fit rounded-3xl bg-slate-900 p-6 text-white shadow-sm">
                <h2 class="text-xl font-bold">Planning equipment transport?</h2>

                <p class="mt-3 text-sm leading-6 text-slate-300">
                    Send us the equipment link and your delivery location. We will help you understand what delivery
                    options
                    may be available.
                </p>

                <div class="mt-6 space-y-3">
                    <a href="tel:{{ config('site.phone_tel') }}"
                       class="block rounded-xl bg-green-600 px-5 py-3 text-center text-sm font-bold hover:bg-green-700">
                        Call {{ config('site.phone') }}
                    </a>

                    <a href="{{ route('contact.index') }}"
                       class="block rounded-xl bg-white px-5 py-3 text-center text-sm font-bold text-slate-900 hover:bg-slate-100">
                        Request delivery info
                    </a>

                    <a href="{{ route('quote.index') }}"
                       class="block rounded-xl border border-white/20 px-5 py-3 text-center text-sm font-bold hover:bg-white/10">
                        Open quote list
                    </a>
                </div>

                <div class="mt-6 rounded-2xl bg-white/10 p-4 text-sm leading-6 text-slate-200">
                    <div class="font-bold text-white">Dealer location</div>
                    <div class="mt-1">{{ config('site.address') }}</div>
                </div>
            </aside>
        </div>
    </section>
@endsection
