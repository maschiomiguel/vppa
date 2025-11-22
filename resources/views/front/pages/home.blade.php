@extends('front.layout.app')

@section('content')
    <main id="homepage">
        <h1 class="visually-hidden">{{ config('app.name') }}</h1>

        <div class="first-section-wrapper">

            <x-hero-section :page="$page" />

            <x-separator-primary bg="#fde5e5" />

            <x-modules-galleries::gallery :page="$page" />

            <x-modules-videos::video :page="$page" />

            <x-separator-secondary />

        </div>
        <div class="second-section-wrapper">
            <x-modules-advantages::advantages :page="$page" />

            <x-modules-testimonials::testimonials :page="$page" />

            <x-separator-primary />
        </div>

        <div class="page-sections-wrapper">
            <x-modules-differentials::differentials :page="$page" />

            <x-company-section :page="$page" />

            <x-modules-questions::questions :page="$page" />
        </div>

        <x-cta-section :page="$page" />

    </main>
@endsection
