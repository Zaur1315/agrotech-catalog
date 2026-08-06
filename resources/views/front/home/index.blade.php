@extends('front.layouts.app', ['title' => 'Farm & Construction Equipment'])

@push('seo')
    <meta name="description" content="Browse farm, construction, utility, and commercial equipment from Moore's Farm Equipment in Gallatin, Tennessee.">
@endpush

@section('content')
    @include('front.components.home.hero-slider', ['hero' => config('home.hero')])
    @include('front.components.home.trust-bar', ['items' => config('home.trust_bar')])
    @include('front.components.home.featured-inventory', ['products' => $featuredProducts])
    @include('front.components.home.category-grid', ['categories' => $categories])
    @include('front.components.home.why-us', ['section' => config('home.why_us')])
    @include('front.components.home.applications', ['section' => config('home.applications')])
    @include('front.components.home.process', ['section' => config('home.process')])
    @include('front.components.home.about', ['section' => config('home.about')])
    @include('front.components.home.faq', ['section' => config('home.faq')])
    @include('front.components.home.final-cta', ['section' => config('home.final_cta')])
@endsection
