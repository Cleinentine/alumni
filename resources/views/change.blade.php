@extends('layouts.app')

@section('content')
    <section class="container-spacing">
        <div class="container-width max-w-screen-2xl mx-auto">
            <x-guest-header icon="fa-unlock-keyhole" text="Change Password" />

            <form action="{{ route('password.reset', $token) }}" method="POST">
                @csrf
                @method("POST")

                <input name="token" type="hidden" value="{{ $token }}">

                @php
                    $hasValues = [1, 0, 0];
                    $icons = ['fa-at', 'fa-key', 'fa-redo'];
                    $ids = ['email', 'password', 'password-confirmation'];
                    $labels = ['Email', 'New Password', 'Repeat New Password'];
                    $names = ['email', 'password', 'password_confirmation'];
                    $placeholders = ['e.g. csuanako@email.com.ph', '', ''];
                    $types = ['email', 'password', 'password'];
                    $values = ['', '', ''];
                @endphp

                @for ($i = 0; $i < count($ids); $i++)
                    <div class="mt-5">
                        <x-label for="{{ $ids[$i] }}" text="{{ $labels[$i] }}" />

                        <x-input
                            :hasValue="$hasValues[$i]"
                            :icon="$icons[$i]"
                            :id="$ids[$i]"
                            :name="$names[$i]"
                            :placeholder="$placeholders[$i]"
                            :type="$types[$i]"
                            :value="$values[$i]"
                        />
                        
                        @error($ids[$i])
                            <x-error-message :message="$message" />
                        @enderror
                    </div>
                @endfor

                <x-button icon="fa-edit" text="Change Password" />

                <div class="mt-5 text-center">
                    @if (session('successMessage'))
                        <x-success-message :message="session('successMessage')" />
                    @endif
                </div>
            </form>
        </div>
    </section>

    @include('includes.facebook')
    @include('includes.footer')
@endsection