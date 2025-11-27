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
        </div>
    </section>

    @include('includes.survey-link')
    @include('includes.facebook')
    @include('includes.footer')
@endsection