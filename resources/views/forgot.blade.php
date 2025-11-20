@extends('layouts.app')

@section('content')
    @include('includes.header')
    
    <section class="container-spacing">
        <div class="container-width max-w-screen-2xl mx-auto">
            <x-guest-header icon="fa-paper-plane" text="Forgot Password" />

            <form action="{{ route('password.request') }}" method="POST">
                @csrf

                <div class="mt-5">
                    <x-label for="email" text="Email" />

                    <x-input
                        hasValue=1
                        icon="fa-at"
                        id="email"
                        name="email"
                        placeholder="e.g. csuanako@email.com.ph"
                        type="email"
                        value="email"
                    />
                    
                    @error('email')
                        <x-error-message :message="$message" />
                    @enderror
                </div>

                <x-button icon="fa-paper-plane" text="Reset Password" />

                <div class="mt-5 text-center">
                    @if (session('successMessage'))
                        <x-success-message :message="session('successMessage')" />
                    @endif
                </div>
            </form>

            <x-horizontal-rule />

            <p class="text-center">
                Remembered your password?

                <x-anchor href="{{ route('login') }}" text="Sign In" />
            </p>
        </div>
    </section>

    @include('includes.survey-link')
    @include('includes.facebook')
    @include('includes.footer')
@endsection