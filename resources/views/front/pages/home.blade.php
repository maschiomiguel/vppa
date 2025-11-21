@extends('front.layout.app')

@section('content')
    <main id="homepage">
        <h1 class="visually-hidden">{{ config('app.name') }}</h1>

        <x-hero-section :page="$page" />

        <x-separator-primary bg="#D9D9D9" />

        <x-modules-galleries::gallery :page="$page" />

        <x-modules-videos::video :page="$page" />

        <x-separator-secondary />

        <x-modules-advantages::advantages :page="$page" />

        <x-separator-primary />

        <div class="page-sections-wrapper">
            <x-modules-differentials::differentials :page="$page" />

            <x-company-section :page="$page" />

            <x-modules-questions::questions :page="$page" />
        </div>

        <x-cta-section :page="$page" />

        <x-modules-testimonials::testimonials name="testimonials" :page="$page" />

    </main>
@endsection
