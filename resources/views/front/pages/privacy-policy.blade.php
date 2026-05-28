@extends('front.layouts.app', ['title' => 'Privacy Policy'])

@section('content')
    @include('front.components.page-banner', [
        'title' => 'Privacy Policy',
        'description' => 'Learn how we collect, use and protect information submitted through this website.',
        'badge' => 'Privacy',
    ])

    <section class="mx-auto max-w-7xl px-4 py-12">
        <div class="grid gap-8 lg:grid-cols-[1fr_380px]">
            <div class="space-y-6">
                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Overview</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        This Privacy Policy explains how {{ config('site.name') }} collects, uses and protects
                        information
                        when you visit this website, browse inventory, submit a quote request, contact us, or interact
                        with
                        our online forms.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        By using this website, you agree to the collection and use of information as described in this
                        policy.
                    </p>
                </div>

                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Information you provide</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        When you submit a contact form, quote request, product inquiry, delivery question, or
                        service-related
                        request, we may collect information such as:
                    </p>

                    <ul class="mt-4 list-disc space-y-2 pl-6 leading-7 text-slate-600">
                        <li>Your name</li>
                        <li>Phone number</li>
                        <li>Email address</li>
                        <li>Preferred contact method</li>
                        <li>Message or request details</li>
                        <li>Equipment or products included in your quote request</li>
                    </ul>
                </div>

                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Information collected automatically</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        When you use this website, certain technical information may be collected automatically for
                        security,
                        analytics, lead tracking and website improvement purposes.
                    </p>

                    <ul class="mt-4 list-disc space-y-2 pl-6 leading-7 text-slate-600">
                        <li>IP address</li>
                        <li>Browser and device information</li>
                        <li>User agent</li>
                        <li>Pages visited</li>
                        <li>Source page of a request</li>
                        <li>UTM campaign parameters</li>
                        <li>Cookie-based advertising identifiers such as Meta Pixel browser identifiers, where
                            applicable
                        </li>
                    </ul>
                </div>

                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">How we use information</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        {{ config('site.name') }} may use collected information to:
                    </p>

                    <ul class="mt-4 list-disc space-y-2 pl-6 leading-7 text-slate-600">
                        <li>Respond to contact messages and quote requests</li>
                        <li>Follow up about equipment availability, pricing, delivery, service or financing questions
                        </li>
                        <li>Send internal email notifications to our team when a new lead is submitted</li>
                        <li>Improve website content, inventory presentation and customer experience</li>
                        <li>Measure marketing performance and advertising campaigns</li>
                        <li>Detect spam, abuse, fraud or suspicious activity</li>
                        <li>Maintain business records related to customer requests</li>
                    </ul>
                </div>

                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Email notifications and lead storage</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        When you submit a form on this website, your request may be saved in our website system and sent
                        by
                        email to {{ config('site.name') }} so our team can respond. These notifications may include your
                        contact details, message, requested equipment, source page, IP address, user agent and campaign
                        data.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        We use this information only for business communication, customer support, lead management and
                        related
                        operational purposes.
                    </p>
                </div>

                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Cookies and tracking technologies</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        This website may use cookies, pixels, analytics tools and similar technologies to understand how
                        visitors
                        use the site, measure advertising performance and improve customer communication.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        Cookies may help us remember technical information, connect a form submission to a marketing
                        campaign,
                        or measure whether a visitor viewed inventory, clicked a contact button, or submitted a lead
                        form.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        You can usually control or disable cookies through your browser settings. Some website features
                        or
                        advertising measurement tools may not work as intended if cookies are disabled.
                    </p>
                </div>

                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Meta Pixel and Conversions API</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        This website may use Meta Pixel and Meta Conversions API to measure advertising performance,
                        improve
                        campaign reporting and understand actions such as page views, product views, contact clicks and
                        lead
                        form submissions.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        When these tools are active, certain event data may be sent to Meta, such as event name, event
                        time,
                        page URL, browser identifiers, IP address, user agent and hashed contact information where
                        applicable.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        Meta may process this information according to its own privacy policies and advertising
                        settings.
                        You can manage advertising preferences through your Meta account settings and browser privacy
                        controls.
                    </p>
                </div>

                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Sharing information</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        We do not sell your personal information. We may share information only when needed to operate
                        the
                        website, respond to your request, support business operations, use service providers, comply
                        with law,
                        prevent abuse, or measure advertising and analytics performance.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        Service providers may include website hosting, email delivery, analytics, advertising, security,
                        customer communication and technical support providers.
                    </p>
                </div>

                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Data security</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        We use reasonable technical and organizational measures to protect information submitted through
                        this
                        website. However, no method of internet transmission or electronic storage is completely secure.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        Please do not submit sensitive financial information, passwords, payment card details, or other
                        highly
                        sensitive information through general contact or quote request forms.
                    </p>
                </div>

                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Data retention</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        We may retain submitted lead information and related technical data for as long as reasonably
                        necessary
                        to respond to requests, manage customer communication, maintain business records, improve the
                        website,
                        comply with legal obligations, and protect our business interests.
                    </p>
                </div>

                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Your choices</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        You may contact us to request that we update, correct or delete information you previously
                        submitted,
                        subject to legal, operational and recordkeeping requirements.
                    </p>

                    <p class="mt-4 leading-7 text-slate-600">
                        You may also control cookies and tracking technologies through your browser settings and
                        advertising
                        platform settings.
                    </p>
                </div>

                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Changes to this policy</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        We may update this Privacy Policy from time to time. Updates will be posted on this page with
                        the
                        latest version of the policy.
                    </p>
                </div>

                <div class="rounded-3xl border bg-white p-6 shadow-sm md:p-8">
                    <h2 class="text-2xl font-bold">Contact us</h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        If you have questions about this Privacy Policy or how your information is handled, contact
                        {{ config('site.name') }}:
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
                <h2 class="text-xl font-bold">Privacy questions?</h2>

                <p class="mt-3 text-sm leading-6 text-slate-300">
                    Contact {{ config('site.name') }} if you have questions about your information, quote requests,
                    lead forms or website tracking.
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
                    <div class="font-bold text-white">Dealer</div>
                    <div class="mt-1">{{ config('site.name') }}</div>
                    <div class="mt-1">{{ config('site.address') }}</div>
                </div>
            </aside>
        </div>
    </section>
@endsection
