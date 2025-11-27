@extends('layouts.app')

@section('content')
    @include('includes.header')
    @include('includes.tracer-navigation')
    
    <section class="relative top-[120px]">
        <section class="container-spacing container-width max-w-screen-2xl mx-auto">
            <x-heading text="Alumni Profile" />

            <div class="text-center">
                @if (session('duplicateData'))
                    <x-error-message :message="session('duplicateData')" />
                @elseif (session('successMessage'))
                    <x-success-message :message="session('successMessage')" />
                @endif
            </div>
            
            <form action="{{ route('tracerGraduate') }}" method="POST">
                @csrf
                @include('includes.graduate-form')

                <x-button icon="fa-user-edit" text="Update Profile" />
            </form>
        </section>

        @include('includes.survey-link')
        @include('includes.facebook')
        @include('includes.footer')
    </section>

    <script>
        document.getElementById("tracer-graduate").classList.toggle("bg-yellow-400");
        document.getElementById("tracer-graduate").style.color = "#000";
    </script>
@endsection