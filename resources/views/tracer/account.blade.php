@extends('layouts.app')

@section('content')
    @include('includes.header')
    @include('includes.tracer-navigation')
    
    <section class="relative top-[120px]">
        <section class="container-spacing container-width max-w-screen-2xl mx-auto">
            <x-heading text="My Account" />

            <div class="text-center">
                @if (session('successMessage'))
                    <x-success-message :message="session('successMessage')" />
                @endif
            </div>
            
            <form action="{{ route('tracerAccount') }}" method="POST">
                @csrf
                @include('includes.user-form')

                <x-button icon="fa-user-edit" text="Update Account" />
            </form>
        </section>

        @include('includes.facebook')
        @include('includes.footer')
    </section>
@endsection