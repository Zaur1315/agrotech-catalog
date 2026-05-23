@extends('front.layouts.app', ['title' => 'Contact Us'])

@section('content')
    @include('front.components.page-banner', [
        'title' => 'Contact our sales team',
        'description' => 'Ask about equipment availability, pricing, delivery, financing or dealer support.',
        'badge' => 'Contact',
    ])

    <section class="mx-auto grid max-w-7xl gap-10 px-4 py-12 lg:grid-cols-[1fr_420px]">
        <div class="overflow-hidden rounded-3xl border bg-white shadow-sm">
            <div class="border-b bg-slate-50 px-6 py-5">
                <h2 class="text-2xl font-bold">Send a message</h2>
                <p class="mt-2 text-sm leading-6 text-slate-600">
                    Fill in the form and we will get back to you as soon as possible.
                </p>
            </div>

            <div class="p-6">
                <div class="mb-5 space-y-4">
                    @include('front.components.form.alert')
                    @include('front.components.form.errors')
                </div>

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                    @csrf

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
                            'placeholder' => '+1 555 300 4000',
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

                    @include('front.components.form.textarea', [
                        'label' => 'Message',
                        'name' => 'message',
                        'rows' => 6,
                        'placeholder' => 'Tell us what equipment you are looking for.',
                    ])

                    <button
                        type="submit"
                        class="rounded-xl bg-green-700 px-6 py-3.5 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-green-900/20 transition hover:bg-green-800"
                    >
                        Send message
                    </button>
                </form>
            </div>
        </div>

        <aside class="space-y-6">
            <div class="rounded-3xl border bg-white p-6 shadow-sm">
                <h2 class="text-xl font-bold">Dealer contact</h2>

                <div class="mt-5 space-y-4 text-sm text-slate-600">
                    <div>
                        <div class="font-semibold text-slate-900">Phone</div>
                        <a href="tel:+15553004000" class="mt-1 inline-block hover:text-green-700">
                            +1 555 300 4000
                        </a>
                    </div>

                    <div>
                        <div class="font-semibold text-slate-900">Email</div>
                        <a href="mailto:sales@agrotech.test" class="mt-1 inline-block hover:text-green-700">
                            sales@agrotech.test
                        </a>
                    </div>

                    <div>
                        <div class="font-semibold text-slate-900">Location</div>
                        <p class="mt-1">Wisconsin, USA</p>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl bg-slate-900 p-6 text-white shadow-sm">
                <h2 class="text-xl font-bold">Looking for several machines?</h2>
                <p class="mt-3 text-sm leading-6 text-slate-300">
                    Add equipment to your quote list and send one request with all selected machines.
                </p>

                <a href="{{ route('quote.index') }}"
                   class="mt-5 inline-flex rounded-xl bg-green-600 px-5 py-3 text-sm font-semibold hover:bg-green-700">
                    Open quote list
                </a>
            </div>
        </aside>
    </section>
@endsection
