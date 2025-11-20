@extends('layouts.app')

@section('content')
    @include('includes.header')
    
    <section class="container-spacing">
        <div class="container-width max-w-screen-2xl mx-auto">
            <x-guest-header icon="fa-check-circle" text="Email Verification" />

            <form action="{{ route('verification.send') }}" method="POST">
                @csrf

                <x-button icon="fa-paper-plane" text="Resend Email Verification" />
            </form>

            <div class="mt-5 text-center">
                @if(session('message'))
                    <x-success-message :message="session('message')" />
                @endif
            </div>

            @if (!Auth::user()->email_verified_at)
                <x-horizontal-rule />

                <p class="text-center">An email was sent to your email upon registration. Please check to be verified to continue.</p>
            @endif
        </div>
    </section>

    @include('includes.survey-link')
    @include('includes.facebook')
    @include('includes.footer')
@endsection