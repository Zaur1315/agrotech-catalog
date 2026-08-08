@php($page = config('pages.contact'))
@extends('front.layouts.app', ['title' => $page['seo']['title']])

@push('seo')
    <meta name="description" content="{{ $page['seo']['description'] }}">
    <meta property="og:title" content="{{ $page['seo']['title'] }} | {{ config('site.name') }}">
    <meta property="og:description" content="{{ $page['seo']['description'] }}">
    @php($heroImage = file_exists(public_path($page['hero']['image'])) ? $page['hero']['image'] : $page['hero']['fallback'])
    <meta property="og:image" content="{{ asset($heroImage) }}">
@endpush

@section('content')
    @php($visitImage = file_exists(public_path($page['visit']['image'])) ? $page['visit']['image'] : $page['visit']['fallback'])
    @include('front.components.public.page-hero', ['content' => $page['hero'], 'crumb' => 'Contact'])

    <section class="public-contact-strip" data-reveal>
        <div class="site-container public-contact-strip__grid">
            <a href="tel:{{ config('site.contact.phone_tel') }}"><span class="public-contact-icon" aria-hidden="true">↗</span><small>Call Us</small><strong>{{ config('site.contact.phone') }}</strong></a>
            <a href="mailto:{{ config('site.contact.email') }}"><span class="public-contact-icon" aria-hidden="true">@</span><small>Email Us</small><strong>{{ config('site.contact.email') }}</strong></a>
            <a href="{{ config('site.contact.maps_url') }}" target="_blank" rel="noopener"><span class="public-contact-icon" aria-hidden="true">⌖</span><small>Visit Us</small><strong>{{ config('site.contact.city') }}, {{ config('site.contact.state') }}</strong></a>
            <a href="{{ config('site.contact.maps_url') }}" target="_blank" rel="noopener"><span class="public-contact-icon" aria-hidden="true">→</span><small>Directions</small><strong>Open in Google Maps</strong></a>
        </div>
    </section>

    <section class="section-shell public-contact-main" data-reveal>
        <div class="site-container public-contact-grid">
            <div class="public-form-card"><p class="section-eyebrow">{{ $page['form']['eyebrow'] }}</p><h2 class="section-title">{{ $page['form']['title'] }}</h2><p class="section-description">{{ $page['form']['description'] }}</p><div class="public-form-notices">@include('front.components.form.alert') @include('front.components.form.errors')</div>
                <form action="{{ route('contact.store') }}" method="POST" class="public-form" data-ajax-form data-success-message="Thank you! Your message has been sent successfully.">
                    @csrf
                    <input type="text" name="website" value="" tabindex="-1" autocomplete="off" class="hidden">
                    @include('front.components.form.meta-tracking-fields')
                    <div class="public-form__row">@include('front.components.form.input', ['label' => 'Full name', 'name' => 'name', 'placeholder' => 'John Farmer', 'required' => true, 'class' => 'public-form__input', 'autocomplete' => 'name']) @include('front.components.form.input', ['label' => 'Phone number', 'name' => 'phone', 'placeholder' => '(615) 555-0123', 'required' => true, 'class' => 'public-form__input', 'autocomplete' => 'tel'])</div>
                    <div class="public-form__row">@include('front.components.form.input', ['label' => 'Email address', 'name' => 'email', 'type' => 'email', 'placeholder' => 'you@example.com', 'class' => 'public-form__input', 'autocomplete' => 'email']) @include('front.components.form.input', ['label' => 'Subject', 'name' => 'subject', 'placeholder' => 'Equipment availability', 'class' => 'public-form__input'])</div>
                    <div class="public-form__row">@include('front.components.form.input', ['label' => 'ZIP code', 'name' => 'zip_code', 'placeholder' => '37066', 'required' => true, 'class' => 'public-form__input', 'autocomplete' => 'postal-code']) @include('front.components.form.preferred-contact-method')</div>
                    @include('front.components.form.textarea', ['label' => 'Message', 'name' => 'message', 'rows' => 6, 'placeholder' => 'Tell us what equipment or question you have.'])
                    @include('front.components.form.consent-checkbox')
                    <button type="submit" class="btn-primary public-form__submit">Send Message</button>
                </form>
            </div>
            <aside class="public-contact-visual"><div class="public-contact-visual__image"><img src="{{ asset($visitImage) }}" width="1000" height="760" loading="lazy" alt="{{ $page['visit']['image_alt'] }}"><span class="image-overlay"></span><div><p class="section-eyebrow section-eyebrow--gold">Prefer to Talk?</p><h2>Call our team.</h2><a href="tel:{{ config('site.contact.phone_tel') }}">{{ config('site.contact.phone') }} ↗</a></div></div><div class="public-contact-visual__details"><p>Questions about a listing, equipment, or visiting the yard? Send the details you have and we will help point you in the right direction.</p><a class="btn-outline" href="mailto:{{ config('site.contact.email') }}">Email {{ config('site.contact.email') }}</a></div></aside>
        </div>
    </section>

    <section class="public-visit" data-reveal>
        <div class="site-container public-visit__grid"><div class="public-visit__media"><img src="{{ asset($visitImage) }}" width="1000" height="700" loading="lazy" alt="{{ $page['visit']['image_alt'] }}"></div><div class="public-visit__body"><p class="section-eyebrow">{{ $page['visit']['eyebrow'] }}</p><h2 class="section-title">{{ $page['visit']['title'] }}</h2><p class="section-description">{{ $page['visit']['description'] }}</p><address>{{ config('site.contact.address') }}</address><a class="btn-primary" href="{{ config('site.contact.maps_url') }}" target="_blank" rel="noopener">Get Directions</a></div></div>
    </section>
@endsection
