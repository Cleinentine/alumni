@extends('layouts.app')

@section('content')
    @include('includes.header')
    
    <section class="container-spacing">
        <div class="container-width max-w-screen-2xl mx-auto">
            <x-guest-header icon="fa-file-signature" text="Terms of Use" />

            @include('includes.terms-content')
        </div>
    </section>

    @include('includes.survey-link')
    @include('includes.facebook')
    @include('includes.footer')
@endsection