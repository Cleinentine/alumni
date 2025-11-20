@extends('layouts.app')

@section('content')
    @include('includes.header')
    
    <section class="container-spacing">
        <div class="container-width max-w-screen-2xl mx-auto">
            <x-guest-header icon="fa-comments" text="Website Survey" />

            <form action="{{ route('survey') }}" method="POST">
                @csrf
                @honeypot

                @for ($i = 0; $i < count($names); $i++)
                    <div class="mt-10">
                        <x-label for="{{ $names[$i] }}" text="{{ $labels[$i] }}" />

                        <x-select
                            :displayText="$values[$i]"
                            :icon="$icons[$i]"
                            :id="$names[$i]"
                            :loop="$loops[$i]"
                            :name="$names[$i]"
                            :selected="$specials[$i]"
                            :special="$specials[$i]"
                            :value="$values[$i]"
                        />

                        @error($names[$i])
                            <x-error-message :message="$message" />
                        @enderror
                    </div>
                @endfor

                <div class="mt-10">
                    <x-label for="comment" text="Comment" />

                    <x-textbox
                        id="comment"
                        name="comment"
                        placeholder="e.g. Hello  World"
                    />

                    @error('comment')
                        <x-error-message :message="$message" />
                    @enderror
                </div>

                <x-button icon="fa-paper-plane" text="Submit Survey" />

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