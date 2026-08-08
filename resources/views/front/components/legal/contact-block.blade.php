@props(['terms' => false])

<section class="legal-contact" data-reveal>
    <div class="site-container legal-contact__inner">
        <div><p class="section-eyebrow section-eyebrow--gold">Questions?</p><h2>{{ $terms ? 'Questions About These Terms?' : 'Questions About This Privacy Policy?' }}</h2><p>{{ $terms ? 'If you have questions about these Terms & Conditions, contact Moore\'s Farm Equipment.' : 'If you have questions about this Privacy Policy or information submitted through the website, contact Moore\'s Farm Equipment.' }}</p></div>
        <div class="legal-contact__actions"><a class="btn-primary" href="mailto:{{ config('site.contact.email') }}">Email Us</a><a class="btn-outline btn-outline--light" href="tel:{{ config('site.contact.phone_tel') }}">Call Us</a><a class="legal-contact__email" href="mailto:{{ config('site.contact.email') }}">{{ config('site.contact.email') }}</a></div>
    </div>
</section>
