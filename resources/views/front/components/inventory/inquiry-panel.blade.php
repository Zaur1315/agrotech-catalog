@php($canRequestQuote = $product->status === \App\Models\Product::STATUS_AVAILABLE)

<aside class="inquiry-card" id="inquiry">
    <p class="section-eyebrow">Equipment inquiry</p>
    <h2>{{ $content['inquiry_title'] }}</h2>
    <p class="inquiry-card__description">{{ $content['inquiry_description'] }}</p>
    <div class="inquiry-card__contacts"><a href="tel:{{ config('site.contact.phone_tel') }}">{{ config('site.contact.phone') }}</a><a href="mailto:{{ config('site.contact.email') }}">{{ config('site.contact.email') }}</a></div>

    @if($canRequestQuote)
        <div class="inquiry-card__form">
            @include('front.components.form.alert')
            @include('front.components.form.errors')
            <form action="{{ route('products.quote', $product) }}" method="POST" class="form-stack" data-ajax-form data-success-message="Thank you! Your quote request has been sent successfully.">
                @csrf
                <input type="text" name="website" value="" tabindex="-1" autocomplete="off" class="hidden">
                @include('front.components.form.meta-tracking-fields')
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                @include('front.components.form.input', ['label' => 'Full name', 'name' => 'name', 'placeholder' => 'John Farmer', 'required' => true])
                @include('front.components.form.input', ['label' => 'Phone number', 'name' => 'phone', 'placeholder' => '(615) 555-0123', 'required' => true])
                @include('front.components.form.input', ['label' => 'Email address', 'name' => 'email', 'type' => 'email', 'placeholder' => 'you@example.com'])
                @include('front.components.form.input', ['label' => 'ZIP code', 'name' => 'zip_code', 'placeholder' => '37066', 'required' => true])
                @include('front.components.form.preferred-contact-method')
                @include('front.components.form.textarea', ['label' => 'Message', 'name' => 'message', 'rows' => 4, 'value' => 'I am interested in ' . $product->name . '.'])
                @include('front.components.form.consent-checkbox')
                <button type="submit" class="btn-primary inquiry-card__submit">Send an Inquiry</button>
            </form>
        </div>
    @else
        <div class="inquiry-card__notice"><p>This listing is not currently available for direct quote requests. Contact us to confirm current status or ask about similar equipment.</p><a class="btn-primary" href="{{ route('contact.index') }}">Contact Our Team</a></div>
    @endif
</aside>
