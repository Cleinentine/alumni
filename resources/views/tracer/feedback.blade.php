@extends('layouts.app')

@section('content')
    @include('includes.header')
    @include('includes.tracer-navigation')
    
    <section class="relative top-[120px]">
        <section class="container-spacing container-width max-w-screen-2xl mx-auto">
            <x-heading text="University Feedback" />
            
            <form action="{{ route('tracerFeedback') }}" method="POST">
                @csrf

                @for ($i = 0; $i < count($names); $i++)
                    <div class="mt-10">
                        <x-label for="{{ $names[$i] }}" text="{{ $labels[$i] }}" />

                        <x-select
                            :displayText="$displayTexts[$i]"
                            :icon="$icons[$i]"
                            :id="$names[$i]"
                            :loop="$loops[$i]"
                            :name="$names[$i]"
                            :selected="$selected[$i]"
                            :special="$specials[$i]"
                            :value="$values[$i]"
                        />

                        @error($names[$i])
                            <x-error-message :message="$message" />
                        @enderror
                    </div>
                @endfor

                <x-button icon="fa-paper-plane" text="Send Feedback" />
            </form>
        </section>

        @include('includes.survey-link')
        @include('includes.facebook')
        @include('includes.footer')
    </section>

    <script>
        document.getElementById("tracer-feedback").classList.toggle("bg-yellow-400");
        document.getElementById("tracer-feedback").style.color = "#000";
    </script>
@endsection