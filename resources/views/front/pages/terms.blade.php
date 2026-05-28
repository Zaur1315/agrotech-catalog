@extends('front.layouts.app', ['title' => 'Terms of Use'])

@section('content')
    @include('front.components.page-banner', [
        'title' => 'Terms of Use',
        'description' => 'Please review these terms before using this website or relying on equipment listing information.',
        'badge' => 'Terms',
    ])

    <section class="mx-auto max-w-7xl px-4 py-12">
        <div class="grid gap-8 lg:grid-cols-[1fr_380px]">
            <div class="space-y-6">
                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Website use</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        This website is operated for informational and communication purposes
                        by {{ config('site.name') }}.
                        By using this website, browsing inventory, submitting a quote request, or contacting us through
                        a form,
                        you agree to use the website only for lawful purposes.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        The information on this website is intended to help customers review available equipment and
                        contact
                        {{ config('site.name') }} for current details. It does not create a binding sales agreement by
                        itself.
                    </p>
                </div>

                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Inventory, pricing and availability</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        Equipment listings, prices, specifications, hours, images, descriptions, attachments,
                        availability,
                        and other details may change without notice. A listing may contain errors, outdated information,
                        or details that require confirmation.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        Please contact us directly before relying on any listing information, visiting our location,
                        arranging
                        transport, or making a purchase decision. Final price, availability, included items, equipment
                        condition,
                        taxes, fees, delivery, and purchase terms must be confirmed directly
                        with {{ config('site.name') }}.
                    </p>
                </div>

                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Used equipment condition</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        Used equipment may have wear, prior repairs, maintenance history, cosmetic issues, mechanical
                        issues,
                        or other condition details based on age, hours, prior use, storage, and service history.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        Customers are encouraged to ask questions, request additional information, and inspect equipment
                        before purchase when possible. Unless otherwise stated in writing, used equipment may be sold
                        as-is.
                    </p>
                </div>

                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Warranty and coverage</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        Warranty coverage is not automatically included with every item. Any warranty, service coverage,
                        return option, inspection promise, or similar protection applies only if it is clearly stated in
                        writing for the specific equipment.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        Website text, general descriptions, or prior conversations should not be treated as a warranty
                        unless
                        they are included in the final written purchase terms.
                    </p>
                </div>

                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Quotes, deposits and payments</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        Submitting a quote request does not reserve equipment and does not guarantee price,
                        availability,
                        financing, delivery, or sale terms. Any quote, deposit, payment instruction, or purchase
                        arrangement
                        must be confirmed directly with {{ config('site.name') }}.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        Do not send payment or sensitive financial information unless you have confirmed the transaction
                        directly with our team using official contact information.
                    </p>
                </div>

                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Delivery and third-party services</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        Delivery options may depend on equipment size, location, distance, timing, transport
                        requirements,
                        and third-party availability. Delivery is not guaranteed unless confirmed in writing.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        Financing, transport, insurance, inspection, or other third-party services may be subject to
                        separate
                        terms, approval, fees, schedules, and provider requirements.
                    </p>
                </div>

                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Trademarks and third-party brands</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        Product names, manufacturer names, logos, model names, and trademarks belong to their respective
                        owners. Their appearance on this website is for identification and equipment description
                        purposes only.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        Unless clearly stated, {{ config('site.name') }} is not claiming endorsement, sponsorship, or
                        official
                        affiliation with any manufacturer or third-party brand.
                    </p>
                </div>

                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Limitation of liability</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        To the fullest extent permitted by law, {{ config('site.name') }} is not responsible for losses
                        or
                        damages resulting from reliance on website information that has not been directly confirmed with
                        us.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        Customers are responsible for verifying equipment suitability, condition, specifications,
                        transport
                        requirements, and purchase terms before completing a transaction.
                    </p>
                </div>

                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Contact</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        If you have questions about these Terms of Use, contact {{ config('site.name') }}:
                    </p>

                    <div class="mt-5 space-y-2 text-slate-700">
                        <p>
                            <strong>Address:</strong>
                            {{ config('site.address') }}
                        </p>

                        <p>
                            <strong>Phone:</strong>
                            <a href="tel:{{ config('site.phone_tel') }}" class="text-green-700 hover:text-green-800">
                                {{ config('site.phone') }}
                            </a>
                        </p>

                        <p>
                            <strong>Email:</strong>
                            <a href="mailto:{{ config('site.email') }}" class="text-green-700 hover:text-green-800">
                                {{ config('site.email') }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <aside class="h-fit rounded-3xl bg-slate-900 p-6 text-white shadow-sm">
                <h2 class="text-xl font-bold">Before you buy</h2>

                <p class="mt-3 text-sm leading-6 text-slate-300">
                    Always confirm current inventory, pricing, condition, warranty, delivery and final terms directly
                    with
                    {{ config('site.name') }} before making a purchase decision.
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

                    <a href="{{ route('catalog.index') }}"
                       class="block rounded-xl border border-white/20 px-5 py-3 text-center text-sm font-bold hover:bg-white/10">
                        View inventory
                    </a>
                </div>

                <div class="mt-6 rounded-2xl bg-white/10 p-4 text-sm leading-6 text-slate-200">
                    <div class="font-bold text-white">Dealer</div>
                    <div class="mt-1">{{ config('site.name') }}</div>
                    <div class="mt-1">{{ config('site.address') }}</div>
                </div>
            </aside>
        </div>
    </section>
@endsection
