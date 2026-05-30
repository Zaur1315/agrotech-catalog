@extends('front.layouts.app', ['title' => 'Contact ' . config('site.name')])

@section('content')
    @include('front.components.page-banner', [
        'title' => 'Contact ' . config('site.name'),
        'description' => 'Ask about equipment availability, quote requests, delivery options, service questions or visiting our location.',
        'badge' => 'Contact',
    ])

    <section class="mx-auto grid max-w-7xl gap-10 px-4 py-12 lg:grid-cols-[1fr_420px]">
        <div class="space-y-8">
            <div class="overflow-hidden rounded-3xl border bg-white shadow-sm">
                <div class="border-b bg-slate-50 px-6 py-5">
                    <h2 class="text-2xl font-black">Send a message</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        Tell us what equipment you are interested in. We can help confirm availability, pricing,
                        condition, delivery options and next steps.
                    </p>
                </div>

                <div class="p-6">
                    <div class="mb-5 space-y-4">
                        @include('front.components.form.alert')
                        @include('front.components.form.errors')
                    </div>

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <input
                            type="text"
                            name="website"
                            value=""
                            tabindex="-1"
                            autocomplete="off"
                            class="hidden"
                        >

                        <div class="grid gap-5 md:grid-cols-2">
                            @include('front.components.form.input', [
                                'label' => 'Full name',
                                'name' => 'name',
                                'placeholder' => 'John Farmer',
                                'required' => true,
                            ])

                            @include('front.components.form.input', [
                                'label' => 'Phone number',
                                'name' => 'phone',
                                'placeholder' => '(304) 555-0123',
                                'required' => true,
                            ])
                        </div>

                        <div class="grid gap-5 md:grid-cols-2">
                            @include('front.components.form.input', [
                                'label' => 'Email address',
                                'name' => 'email',
                                'type' => 'email',
                                'placeholder' => 'john@example.com',
                            ])

                            @include('front.components.form.input', [
                                'label' => 'Subject',
                                'name' => 'subject',
                                'placeholder' => 'Equipment availability',
                            ])
                        </div>

                        @include('front.components.form.preferred-contact-method')

                        @include('front.components.form.textarea', [
                            'label' => 'Message',
                            'name' => 'message',
                            'rows' => 6,
                            'placeholder' => 'Tell us what equipment you are looking for, where you are located, and whether you need delivery or service information.',
                        ])

                        <button
                            type="submit"
                            class="rounded-2xl bg-green-700 px-6 py-3.5 text-sm font-black uppercase tracking-wide text-white shadow-lg shadow-green-900/20 transition hover:bg-green-800"
                        >
                            Send message
                        </button>
                    </form>
                </div>
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <a href="{{ route('catalog.index') }}"
                   class="rounded-3xl border bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="text-sm font-bold uppercase tracking-wide text-green-700">Inventory</div>
                    <h3 class="mt-3 text-xl font-black">Browse equipment</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-600">
                        Review tractors, implements, attachments and other equipment before sending a quote request.
                    </p>
                </a>

                <a href="{{ route('quote.index') }}"
                   class="rounded-3xl border bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="text-sm font-bold uppercase tracking-wide text-green-700">Quote list</div>
                    <h3 class="mt-3 text-xl font-black">Request multiple items</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-600">
                        Add multiple equipment listings to your quote list and send one combined request.
                    </p>
                </a>

                <a href="{{ route('pages.delivery') }}"
                   class="rounded-3xl border bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="text-sm font-bold uppercase tracking-wide text-green-700">Delivery</div>
                    <h3 class="mt-3 text-xl font-black">Ask about transport</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-600">
                        Send your delivery location and equipment interest so options can be reviewed.
                    </p>
                </a>

                <a href="{{ route('pages.service') }}"
                   class="rounded-3xl border bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="text-sm font-bold uppercase tracking-wide text-green-700">Service</div>
                    <h3 class="mt-3 text-xl font-black">Equipment support</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-600">
                        Ask about maintenance, attachments, condition details or practical equipment questions.
                    </p>
                </a>
            </div>
        </div>

        <aside class="space-y-6">
            <div class="rounded-3xl bg-slate-900 p-6 text-white shadow-sm">
                <h2 class="text-xl font-black">{{ config('site.name') }}</h2>

                <p class="mt-3 text-sm leading-6 text-slate-300">
                    Contact us before visiting to confirm current inventory, pricing, condition and availability.
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

                <div class="mt-6 grid gap-3">
                    <a href="tel:{{ config('site.phone_tel') }}"
                       class="rounded-2xl bg-green-600 px-5 py-3 text-center text-sm font-black text-white hover:bg-green-700">
                        Call now
                    </a>

                    <a href="{{ route('catalog.index') }}"
                       class="rounded-2xl bg-white px-5 py-3 text-center text-sm font-black text-slate-900 hover:bg-slate-100">
                        View inventory
                    </a>
                </div>
            </div>

            <div class="rounded-3xl border bg-white p-6 shadow-sm">
                <h2 class="text-xl font-black">Before you visit</h2>

                <p class="mt-3 text-sm leading-6 text-slate-600">
                    Website inventory may change. Please call or send a message before visiting to confirm that the
                    equipment you want to see is still available.
                </p>

                <div class="mt-5 rounded-2xl bg-amber-50 p-4 text-sm leading-6 text-amber-900">
                    Inventory, pricing, hours, specifications, condition and delivery terms should be confirmed directly
                    before purchase.
                </div>
            </div>

            <div class="rounded-3xl border bg-white p-6 shadow-sm">
                <h2 class="text-xl font-black">What to include</h2>

                <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-600">
                    <li class="flex gap-3">
                        <span class="mt-1 h-2 w-2 shrink-0 rounded-full bg-green-600"></span>
                        Equipment name or link
                    </li>
                    <li class="flex gap-3">
                        <span class="mt-1 h-2 w-2 shrink-0 rounded-full bg-green-600"></span>
                        Your preferred contact method
                    </li>
                    <li class="flex gap-3">
                        <span class="mt-1 h-2 w-2 shrink-0 rounded-full bg-green-600"></span>
                        Delivery location, if needed
                    </li>
                    <li class="flex gap-3">
                        <span class="mt-1 h-2 w-2 shrink-0 rounded-full bg-green-600"></span>
                        Questions about condition, attachments, warranty or service
                    </li>
                </ul>
            </div>
        </aside>
    </section>
@endsection
