@extends('layouts.app')

@section('content')
    @include('includes.header')
    
    <section class="container-spacing">
        <div class="container-width max-w-screen-2xl mx-auto">
            <x-guest-header icon="fa-user-plus" text="Register" />

            <form action="{{ route('register') }}" method="POST">
                @csrf

                @php
                    $hasValues = [1, 1, 1, 1, 1];
                    $selected = ['', ''];
                    $values = ['first_name', 'middle_name', 'last_name', 'birth_date', 'year_graduated'];
                @endphp

                @include('includes.graduate-form')
                @include('includes.user-form')

                <section class="mt-10 text-center">
                    <div class="border border-red-900/10 h-[300px] mb-5 p-5 overflow-y-scroll">
                        @include('includes.terms-content')
                    </div>

                    <x-input-checkbox id="terms" name="terms" />

                    <label class="cursor-pointer ml-1" for="terms">I agree to the Terms of Use</label>
                </section>

                <div class="text-center">
                    @error('terms')
                        <x-error-message :message="$message" />
                    @enderror
                </div>

                <x-button icon="fa-user-plus" text="Register" />
            </form>

            <x-horizontal-rule />

            <p class="text-center">
                Have an account?

                <x-anchor href="{{ route('login') }}" text="Sign-In" />
            </p>
        </div>
    </section>

    @include('includes.survey-link')
    @include('includes.facebook')
    @include('includes.footer')
@endsection