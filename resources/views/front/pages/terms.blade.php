@php
    $legal = config('legal.terms');
    $toc = [
        ['number' => '01', 'id' => 'acceptance-of-terms', 'label' => 'Acceptance of Terms'],
        ['number' => '02', 'id' => 'website-purpose', 'label' => 'Website Purpose'],
        ['number' => '03', 'id' => 'equipment-listings', 'label' => 'Equipment Listings'],
        ['number' => '04', 'id' => 'pricing-and-availability', 'label' => 'Pricing and Availability'],
        ['number' => '05', 'id' => 'product-information', 'label' => 'Product Information'],
        ['number' => '06', 'id' => 'website-inquiries', 'label' => 'Website Inquiries'],
        ['number' => '07', 'id' => 'no-online-purchase', 'label' => 'No Online Purchase Agreement'],
        ['number' => '08', 'id' => 'acceptable-use', 'label' => 'Acceptable Use'],
        ['number' => '09', 'id' => 'intellectual-property', 'label' => 'Intellectual Property'],
        ['number' => '10', 'id' => 'third-party-links', 'label' => 'Third-Party Links'],
        ['number' => '11', 'id' => 'website-information', 'label' => 'Website Information'],
        ['number' => '12', 'id' => 'limitation-of-liability', 'label' => 'Limitation of Liability'],
        ['number' => '13', 'id' => 'website-changes', 'label' => 'Changes to the Website'],
        ['number' => '14', 'id' => 'terms-changes', 'label' => 'Changes to These Terms'],
        ['number' => '15', 'id' => 'governing-law', 'label' => 'Governing Law'],
        ['number' => '16', 'id' => 'terms-contact', 'label' => 'Contact Us'],
    ];
@endphp

@extends('front.layouts.app', ['title' => $legal['title']])

@push('seo')
    <meta name="description" content="Review the Terms & Conditions governing use of the Moore's Farm Equipment website and online equipment listings.">
    <link rel="canonical" href="{{ route('pages.terms') }}">
@endpush

@section('content')
    @include('front.components.legal.hero', ['content' => $legal, 'crumb' => 'Terms & Conditions'])

    <div class="legal-page">
        <div class="site-container legal-layout">
            @include('front.components.legal.toc', ['items' => $toc])
            <article class="legal-content">
                <section id="acceptance-of-terms" class="legal-section"><span class="legal-section__number">01</span><h2>Acceptance of Terms</h2><p>By accessing or using this website, you agree to these Terms & Conditions. If you do not agree with these terms, please do not use the website.</p></section>
                <section id="website-purpose" class="legal-section"><span class="legal-section__number">02</span><h2>Website Purpose</h2><p>The website is provided to display information about Moore's Farm Equipment, available equipment, and ways to contact our team. It is an informational website and does not by itself complete an equipment transaction.</p></section>
                <section id="equipment-listings" class="legal-section"><span class="legal-section__number">03</span><h2>Equipment Listings</h2><p>Equipment inventory may change without notice. A listing appearing on the website does not guarantee that the equipment remains available. A listing may be updated, removed, sold, or otherwise become unavailable before the website changes.</p><p>Photographs, descriptions, specifications, condition information, hours, attachments, and other listing details are provided to help visitors begin a conversation. Please contact Moore's Farm Equipment to confirm important information before relying on it.</p></section>
                <section id="pricing-and-availability" class="legal-section"><span class="legal-section__number">04</span><h2>Pricing and Availability</h2><p>Prices displayed on the website are provided for informational purposes and should be confirmed with Moore's Farm Equipment before any transaction. Availability and pricing may change.</p><p>Additional terms or costs, if applicable to a transaction, will be addressed separately between the parties.</p></section>
                <section id="product-information" class="legal-section"><span class="legal-section__number">05</span><h2>Product Information</h2><p>We make reasonable efforts to present equipment information accurately, but listing details, specifications, hours, condition descriptions, photographs, and other information may contain errors or may change.</p><p>Visitors are responsible for asking questions and confirming the details that matter to their intended use before making a purchase decision.</p></section>
                <section id="website-inquiries" class="legal-section"><span class="legal-section__number">06</span><h2>Website Inquiries</h2><p>When you submit a contact, quote, or equipment inquiry, you are asking Moore's Farm Equipment to review the information and communicate with you. A submission does not guarantee a response, equipment availability, a quoted price, or any particular outcome.</p></section>
                <section id="no-online-purchase" class="legal-section"><span class="legal-section__number">07</span><h2>No Online Purchase Agreement</h2><p>Submitting a contact or equipment inquiry through the website does not create a purchase agreement, reservation, financing agreement, or other binding transaction. The website does not by itself complete an equipment purchase or transfer ownership of equipment.</p><p>Any transaction is subject to separate terms agreed between the parties.</p></section>
                <section id="acceptable-use" class="legal-section"><span class="legal-section__number">08</span><h2>Acceptable Use</h2><p>You may use the website only for lawful purposes and in a way that does not interfere with its operation or other visitors. You must not attempt unauthorized access, introduce malicious code, misuse a form, scrape the website in a harmful way, or use the website to send unlawful, deceptive, or abusive material.</p></section>
                <section id="intellectual-property" class="legal-section"><span class="legal-section__number">09</span><h2>Intellectual Property</h2><p>The website, its design, Moore's Farm Equipment branding, and original website content are protected by applicable intellectual property laws. You may view the website for personal or business evaluation, but you may not copy, modify, publish, or commercially exploit website content without permission.</p><p>Third-party trademarks, manufacturer names, logos, model names, and product materials remain the property of their respective owners.</p></section>
                <section id="third-party-links" class="legal-section"><span class="legal-section__number">10</span><h2>Third-Party Links</h2><p>The website may include links to third-party websites, including mapping services or manufacturer resources. Those websites are not controlled by Moore's Farm Equipment and may have separate terms, privacy practices, and content. We are not responsible for third-party websites.</p></section>
                <section id="website-information" class="legal-section"><span class="legal-section__number">11</span><h2>Disclaimer of Website Information</h2><p>The website and its content are provided for general informational purposes. While we make reasonable efforts to keep information current, we do not guarantee that every website detail will always be complete, accurate, or current.</p><p>Information on the website should not replace direct questions, inspection, or separate written terms for a particular equipment transaction.</p></section>
                <section id="limitation-of-liability" class="legal-section"><span class="legal-section__number">12</span><h2>Limitation of Liability</h2><p>To the fullest extent permitted by law, Moore's Farm Equipment will not be responsible for losses or damages arising solely from your use of, or reliance on, website content that has not been directly confirmed with us.</p><p>This section does not limit rights or obligations that cannot lawfully be excluded or limited.</p></section>
                <section id="website-changes" class="legal-section"><span class="legal-section__number">13</span><h2>Changes to the Website</h2><p>We may change, suspend, or discontinue parts of the website, including listings, descriptions, features, or links, at any time without notice.</p></section>
                <section id="terms-changes" class="legal-section"><span class="legal-section__number">14</span><h2>Changes to These Terms</h2><p>We may update these Terms & Conditions from time to time. The revised version will be posted on this page with a new “Last Updated” date. Your continued use of the website after an update means that you accept the revised terms.</p></section>
                <section id="governing-law" class="legal-section"><span class="legal-section__number">15</span><h2>Governing Law</h2><p>These Terms are governed by the laws applicable in the State of Tennessee, without regard to conflict-of-law principles.</p></section>
                <section id="terms-contact" class="legal-section"><span class="legal-section__number">16</span><h2>Contact Us</h2><p>If you have questions about these Terms & Conditions, contact Moore's Farm Equipment.</p><div class="legal-contact-details"><strong>{{ config('site.name') }}</strong><address>{{ config('site.contact.address') }}</address><a href="tel:{{ config('site.contact.phone_tel') }}">{{ config('site.contact.phone') }}</a><a href="mailto:{{ config('site.contact.email') }}">{{ config('site.contact.email') }}</a></div></section>
            </article>
        </div>
    </div>

    @include('front.components.legal.contact-block', ['terms' => true])
@endsection
