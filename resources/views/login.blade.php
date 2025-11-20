@extends('layouts.app')

@section('content')
    @include('includes.header')
    
    <section class="container-spacing">
        <div class="container-width max-w-screen-2xl mx-auto">
            <x-guest-header icon="fa-right-to-bracket" text="Sign-In" />

            <form action="{{ route('login') }}" method="POST">
                @csrf

                @for ($i = 0; $i < count($ids); $i++)
                    <div class="mt-5">
                        <x-label for="{{ $ids[$i] }}" text="{{ $labels[$i] }}" />

                        <x-input
                            :hasValue="$hasValues[$i]"
                            :icon="$icons[$i]"
                            :id="$ids[$i]"
                            :name="$ids[$i]"
                            :placeholder="$placeholders[$i]"
                            :type="$types[$i]"
                            :value="$values[$i]"
                        />
                        
                        @error($ids[$i])
                            <x-error-message :message="$message" />
                        @enderror
                    </div>
                @endfor

                <div class="gap-5 grid grid-cols-2 mt-2 mx-1">
                    <div>
                        <x-input-checkbox id="remember" name="remember" />

                        <label class="cursor-pointer ml-1" for="remember">Remember Me</label>
                    </div>

                    <div class="text-right">
                        <p>
                            <x-anchor href="{{ route('password.request') }}" text="Forgot Password" />
                        </p>
                    </div>
                </div>

                <x-button icon="fa-right-to-bracket" text="Sign In" />

                <div class="mt-5 text-center">
                    @if (session('errorMessage'))
                        <x-error-message :message="session('errorMessage')" />
                    @elseif (session('successMessage'))
                        <x-success-message :message="session('successMessage')" />
                    @endif
                </div>
            </form>

            <x-horizontal-rule />

            <p class="text-center">
                Don 't have an account yet?

                <x-anchor href="{{ route('register') }}" text="Create an Account" />
            </p>
        </div>
    </section>

    @include('includes.survey-link')
    @include('includes.facebook')
    @include('includes.footer')
    @vite(['resources/js/password-text.js'])
@endsection