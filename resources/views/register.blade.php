@extends('layouts.app')

@section('content')
    <section class="container-spacing">
        <div class="container-width max-w-screen-2xl mx-auto">
            <x-guest-header icon="fa-user-plus" text="Register" />

            <form action="{{ route('register') }}" method="POST">
                @csrf
                @include('includes.user-form')

                <x-button icon="fa-user-plus" text="Register" />
            </form>

            <x-horizontal-rule />

            <p class="text-center">
                Have an account?

                <x-anchor href="{{ route('login') }}" text="Sign-In" />
            </p>
        </div>
    </section>

    @include('includes.facebook')
    @include('includes.footer')
@endsection