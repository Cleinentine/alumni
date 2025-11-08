@extends('layouts.app')

@section('content')
    <section class="container-spacing max-w-screen-2xl mx-auto">
        <form action="{{ route('tracer') }}" method="POST">
            @csrf
            @method("POST")

            @include('includes.tracer.graduate')

            <div class="my-[100px]">
                <x-horizontal-rule />
            </div>

            @include('includes.tracer.employment')

            <div class="my-[100px]">
                <x-horizontal-rule />
            </div>

            @include('includes.tracer.feedback')

            <div class="my-[100px]">
                <x-horizontal-rule />
            </div>

            @include('includes.tracer.account')

            <x-button icon="fa-floppy-disk" text="Save Details" />

            <div class="mt-5 text-center">
                @if (session('successMessage'))
                    <x-success-message :message="session('successMessage')" />
                @endif
            </div>
        </form>
    </section>

    @include('includes.footer')
@endsection