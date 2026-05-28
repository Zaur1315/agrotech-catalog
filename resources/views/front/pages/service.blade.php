@extends('front.layouts.app', ['title' => 'Service & Maintenance'])

@section('content')
    @include('front.components.page-banner', [
        'title' => 'Service & Maintenance Support',
        'description' => 'Practical equipment support, maintenance guidance, attachment help and service-related questions for your next machine.',
        'badge' => 'Service',
    ])

    <section class="mx-auto max-w-7xl px-4 py-12">
        <div class="grid gap-8 lg:grid-cols-[1fr_380px]">
            <div class="space-y-8">
                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">
                        Keep your equipment ready for work
                    </h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        {{ config('site.name') }} helps customers make confident equipment decisions before and after a
                        purchase.
                        Whether you are comparing machines, checking condition, planning maintenance, or matching
                        attachments,
                        our team can help you understand the practical details before you move forward.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        Our goal is to make the process clear and useful: answer your questions, explain available
                        equipment
                        information, and help you choose a machine that fits your farm, land, construction, or property
                        work.
                    </p>
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold">Maintenance questions</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">
                            Ask about general maintenance needs, service intervals, condition notes, and what to review
                            before using a machine.
                        </p>
                    </div>

                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold">Attachment support</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">
                            Need help with loaders, mowers, implements, trailers, or other attachments? Contact us with
                            your equipment details.
                        </p>
                    </div>

                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold">Pre-purchase review</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">
                            Before you buy, we can help confirm availability, known specifications, pricing details, and
                            equipment condition.
                        </p>
                    </div>

                    <div class="rounded-2xl border bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold">Parts & practical guidance</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">
                            If you need parts direction or general equipment support, send us a message and we will help
                            point you in the right direction.
                        </p>
                    </div>
                </div>

                <div class="rounded-3xl border bg-slate-50 p-6 md:p-8">
                    <h2 class="text-2xl font-bold">Questions before visiting?</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        Tell us which machine you are interested in and what kind of work you need it for. We can help
                        you review the equipment,
                        discuss availability, and prepare the right questions before you visit our location
                        at {{ config('site.address') }}.
                    </p>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('catalog.index') }}"
                           class="rounded-xl bg-green-700 px-5 py-3 text-sm font-bold text-white hover:bg-green-800">
                            View inventory
                        </a>

                        <a href="{{ route('contact.index') }}"
                           class="rounded-xl border bg-white px-5 py-3 text-sm font-bold hover:bg-slate-100">
                            Send a message
                        </a>
                    </div>
                </div>
            </div>

            <aside class="h-fit rounded-3xl bg-slate-900 p-6 text-white shadow-sm">
                <h2 class="text-xl font-bold">Need service help?</h2>

                <p class="mt-3 text-sm leading-6 text-slate-300">
                    Call or send a message with your equipment details. We will help you understand the next practical
                    step.
                </p>

                <div class="mt-6 space-y-3">
                    <a href="tel:{{ config('site.phone_tel') }}"
                       class="block rounded-xl bg-green-600 px-5 py-3 text-center text-sm font-bold hover:bg-green-700">
                        Call {{ config('site.phone') }}
                    </a>

                    <a href="mailto:{{ config('site.email') }}"
                       class="block rounded-xl bg-white px-5 py-3 text-center text-sm font-bold text-slate-900 hover:bg-slate-100">
                        Email {{ config('site.email') }}
                    </a>

                    <a href="{{ route('contact.index') }}"
                       class="block rounded-xl border border-white/20 px-5 py-3 text-center text-sm font-bold hover:bg-white/10">
                        Contact us
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
