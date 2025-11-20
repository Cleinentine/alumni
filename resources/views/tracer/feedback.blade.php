@extends('layouts.app')

@section('content')
    @include('includes.header')
    @include('includes.tracer-navigation')
    
    <section class="relative top-[120px]">
        <section class="container-spacing container-width max-w-screen-2xl mx-auto">
            <x-heading text="University Feedback" />
            
            <form action="{{ route('tracerFeedback') }}" method="POST">
                @csrf

                    @php
                    $ratingDisplayTexts = ['5 - Excellent', '4 - Good', '3 - Neutral', '2 - Poor', '1 - Very Poor'];
                    $ratingValues = [5, 4, 3, 2, 1];
                    $yesNo = ['Yes', 'No'];

                    $displayTexts = [
                        $ratingDisplayTexts, $ratingDisplayTexts, $ratingDisplayTexts,
                        $yesNo, $yesNo, $yesNo
                    ];

                    $icons = ['fa-book', 'fa-code', 'fa-user-tie', 'fa-user-graduate', 'fa-building-columns', 'fa-shop'];
                    $labels = ['Relevance of the Curriculum (Required)', 'Skills Acquired (Required)', 'Competency (Required)', 'Post Graduate (Required)', 'Engagement with the University (Required)', 'Entrepreneurship (Required)'];
                    $loops = [count($ratingValues), count($ratingValues), count($ratingValues), 2, 2, 2];
                    $names = ['relevance', 'skills', 'competency', 'post_graduate', 'engagement', 'entrepreneurship'];
                    $selected = ['', '', '', '' ,'' ,''];
                    $specials = ['', '', '', '', '', ''];

                    $values = [
                        $ratingValues, $ratingValues, $ratingValues,
                        $yesNo, $yesNo, $yesNo
                    ];
                @endphp

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