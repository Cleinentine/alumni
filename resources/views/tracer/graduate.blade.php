@extends('layouts.app')

@section('content')
    <section class="container-spacing container-width max-w-screen-2xl mx-auto">
        <x-heading text="Alumni Profile" />

        <div class="text-center">
            @if (session('successMessage'))
                <x-success-message :message="session('successMessage')" />
            @endif
        </div>

        @php
            $hasValues = [0, 0, 0, 0, 0];
            $selected = [$graduate->gender, $graduate->program_id];

            $values = [
                $graduate->first_name,
                $graduate->middle_name,
                $graduate->last_name,
                $graduate->birth_date,
                $graduate->year_graduated
            ];
        @endphp
        
        <form action="{{ route('tracerGraduate') }}" method="POST">
            @csrf
            @include('includes.graduate-form')

            <x-button icon="fa-user-edit" text="Update Profile" />
        </form>
    </section>

    @include('includes.facebook')
    @include('includes.footer')
@endsection