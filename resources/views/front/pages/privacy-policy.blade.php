@php
    $legal = config('legal.privacy');
    $toc = [
        ['number' => '01', 'id' => 'introduction', 'label' => 'Introduction'],
        ['number' => '02', 'id' => 'information-we-collect', 'label' => 'Information We Collect'],
        ['number' => '03', 'id' => 'information-you-provide', 'label' => 'Information You Provide'],
        ['number' => '04', 'id' => 'automatic-information', 'label' => 'Automatically Collected Information'],
        ['number' => '05', 'id' => 'how-we-use-information', 'label' => 'How We Use Information'],
        ['number' => '06', 'id' => 'cookies-and-similar-technologies', 'label' => 'Cookies and Similar Technologies'],
        ['number' => '07', 'id' => 'how-we-share-information', 'label' => 'How We Share Information'],
        ['number' => '08', 'id' => 'third-party-links-and-services', 'label' => 'Third-Party Links and Services'],
        ['number' => '09', 'id' => 'data-security', 'label' => 'Data Security'],
        ['number' => '10', 'id' => 'data-retention', 'label' => 'Data Retention'],
        ['number' => '11', 'id' => 'your-choices', 'label' => 'Your Choices'],
        ['number' => '12', 'id' => 'childrens-privacy', 'label' => "Children's Privacy"],
        ['number' => '13', 'id' => 'changes-to-this-policy', 'label' => 'Changes to This Policy'],
        ['number' => '14', 'id' => 'contact-us', 'label' => 'Contact Us'],
    ];
@endphp

@extends('front.layouts.app', ['title' => $legal['title']])

@push('seo')
    <meta name="description" content="Read the Moore's Farm Equipment Privacy Policy to learn how information submitted through our website is handled.">
    <link rel="canonical" href="{{ route('pages.privacy-policy') }}">
@endpush

@section('content')
    @include('front.components.legal.hero', ['content' => $legal, 'crumb' => 'Privacy Policy'])

    <div class="legal-page">
        <div class="site-container legal-layout">
            @include('front.components.legal.toc', ['items' => $toc])
            <article class="legal-content">
                <section id="introduction" class="legal-section"><span class="legal-section__number">01</span><h2>Introduction</h2><p>Moore's Farm Equipment respects the privacy of visitors to our website. This Privacy Policy describes the types of information we may receive through the website, how that information may be used, and the choices available to visitors.</p><p>This policy applies to information collected through this website, including information submitted through contact, quote, and equipment inquiry forms.</p></section>
                <section id="information-we-collect" class="legal-section"><span class="legal-section__number">02</span><h2>Information We Collect</h2><p>Depending on how you use the website, we may receive information you submit directly, technical information about a visit, and information associated with a form request or campaign link.</p><ul><li>Contact details and message content submitted through a form.</li><li>Information about equipment or listings included in an inquiry or quote request.</li><li>Technical and request information used to operate, secure, and understand the website.</li></ul></section>
                <section id="information-you-provide" class="legal-section"><span class="legal-section__number">03</span><h2>Information You Provide</h2><p>When you contact us through the website, we may receive your name, phone number, email address, ZIP code, preferred contact method, subject, message, and information about the equipment you are asking about.</p><p>Some fields are required to submit a particular form. You can choose whether to include optional information, such as an email address or additional message details.</p></section>
                <section id="automatic-information" class="legal-section"><span class="legal-section__number">04</span><h2>Automatically Collected Information</h2><p>Website requests may include basic technical information such as your IP address, browser and device information, user agent, requested pages, date and time of requests, referring page, and the page associated with a submission.</p><p>Forms may also receive campaign parameters such as UTM values. When the applicable tracking configuration is enabled, the website may receive Meta browser or click identifiers, including values associated with <code>_fbp</code>, <code>_fbc</code>, or a <code>fbclid</code> parameter.</p></section>
                <section id="how-we-use-information" class="legal-section"><span class="legal-section__number">05</span><h2>How We Use Information</h2><p>We may use information to:</p><ul><li>Respond to questions and website inquiries.</li><li>Communicate about equipment listings and quote requests.</li><li>Process and route contact form submissions.</li><li>Send an internal notification when a new lead is submitted.</li><li>Maintain website security and help prevent spam or abuse.</li><li>Understand technical problems and operate the website.</li><li>Maintain business records related to requests and communications.</li><li>Meet applicable legal or business requirements.</li></ul></section>
                <section id="cookies-and-similar-technologies" class="legal-section"><span class="legal-section__number">06</span><h2>Cookies and Similar Technologies</h2><p>The website may use cookies or similar browser technologies that are necessary for basic website functionality, security, session management, or form processing. Laravel session and CSRF protections may rely on browser cookies.</p><p>If Meta Pixel is enabled in the website configuration, the site may load Meta Pixel to record page views and, after applicable form activity, lead-related events. The website may use browser identifiers or campaign information for that measurement. Meta handles information it receives according to its own policies.</p><p>You can control cookies through your browser settings. Disabling cookies may affect session-based or form-related website functionality.</p></section>
                <section id="how-we-share-information" class="legal-section"><span class="legal-section__number">07</span><h2>How We Share Information</h2><p>We do not sell personal information collected through this website. We may share information where reasonably necessary with service providers that help us host the website, deliver email, maintain security, process communications, or support the operation of the website.</p><p>We may also disclose information when reasonably necessary to comply with law, respond to a lawful request, protect rights or safety, investigate abuse, or support a business change such as a merger or asset transfer.</p><p>If Meta Pixel or Meta Conversions API is enabled, relevant event and contact information may be sent to Meta for the configured measurement and lead functions.</p></section>
                <section id="third-party-links-and-services" class="legal-section"><span class="legal-section__number">08</span><h2>Third-Party Links and Services</h2><p>The website may link to third-party websites, including mapping or equipment-related resources. Those websites operate under their own terms and privacy practices. Moore's Farm Equipment does not control and is not responsible for the privacy practices or content of external websites.</p></section>
                <section id="data-security" class="legal-section"><span class="legal-section__number">09</span><h2>Data Security</h2><p>We use reasonable administrative and technical measures designed to protect information handled through the website. However, no method of internet transmission or electronic storage can be guaranteed to be completely secure.</p><p>Please do not submit passwords, payment card details, government identification numbers, or other highly sensitive information through a general website form.</p></section>
                <section id="data-retention" class="legal-section"><span class="legal-section__number">10</span><h2>Data Retention</h2><p>We may retain information for as long as reasonably necessary to respond to inquiries, maintain business records, resolve disputes, protect the website, and meet applicable legal or business requirements.</p></section>
                <section id="your-choices" class="legal-section"><span class="legal-section__number">11</span><h2>Your Choices</h2><p>You may contact us to ask about information you previously submitted through the website or to request that it be updated, corrected, or deleted, subject to applicable legal, operational, and recordkeeping requirements.</p><p>You may also manage browser cookies and available Meta advertising controls through your browser or Meta account settings.</p></section>
                <section id="childrens-privacy" class="legal-section"><span class="legal-section__number">12</span><h2>Children's Privacy</h2><p>This website is intended for a general audience and is not directed to children under 13. We do not knowingly seek to collect personal information from children through this website.</p></section>
                <section id="changes-to-this-policy" class="legal-section"><span class="legal-section__number">13</span><h2>Changes to This Policy</h2><p>We may update this Privacy Policy from time to time. When it is updated, the revised version will be posted on this page with a new “Last Updated” date.</p></section>
                <section id="contact-us" class="legal-section"><span class="legal-section__number">14</span><h2>Contact Us</h2><p>If you have questions about this Privacy Policy or how information is handled, contact Moore's Farm Equipment.</p><div class="legal-contact-details"><strong>{{ config('site.name') }}</strong><address>{{ config('site.contact.address') }}</address><a href="tel:{{ config('site.contact.phone_tel') }}">{{ config('site.contact.phone') }}</a><a href="mailto:{{ config('site.contact.email') }}">{{ config('site.contact.email') }}</a></div></section>
            </article>
        </div>
    </div>

    @include('front.components.legal.contact-block')
@endsection
