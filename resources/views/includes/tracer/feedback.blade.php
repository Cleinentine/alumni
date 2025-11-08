<section class="container-width mx-auto">
    <x-heading text="Feedback to University" />

    @php
        $ratingDisplayTexts = ['5 - Excellent', '4 - Good', '3 - Neutral', '2 - Poor', '1 - Very Poor'];
        $ratingValues = [5, 4, 3, 2, 1];
        $yesNo = ['Yes', 'No'];

        $displayTexts = [
            $ratingDisplayTexts, $ratingDisplayTexts, $ratingDisplayTexts,
            $yesNo, $yesNo, $yesNo
        ];

        $icons = ['fa-book', 'fa-code', 'fa-user-tie', 'fa-user-graduate', 'fa-building-columns', 'fa-shop'];
        $ids = ['relevance', 'skills', 'competency', 'post-graduate', 'engagement', 'entrepreneurship'];
        $labels = ['Relevance of Curriculum (Required)', 'Skills Acquired (Required)', 'Competency (Required)', 'Post Graduate (Required)', 'Engagement with University (Required)', 'Entrepreneurship (Required)'];
        $loops = [count($ratingValues), count($ratingValues), count($ratingValues), 2, 2, 2];
        $names = ['relevance', 'skills', 'competency', 'post_gradaute', 'engagement', 'entrepreneurship'];
        $specials = ['', '', '', '', '', ''];

        $values = [
            $ratingValues, $ratingValues, $ratingValues,
            $yesNo, $yesNo, $yesNo
        ];
    @endphp

    @for ($i = 0; $i < count($ids); $i++)
        <div class="mt-5">
            <x-label for="{{ $ids[$i] }}" text="{{ $labels[$i] }}" />

            <x-select
                :displayText="$displayTexts[$i]"
                :icon="$icons[$i]"
                :id="$ids[$i]"
                :loop="$loops[$i]"
                :name="$ids[$i]"
                :special="$specials[$i]"
                :value="$values[$i]"
            />

            @error($names[$i])
                <x-error-message :message="$message" />
            @enderror
        </div>
    @endfor
</section>