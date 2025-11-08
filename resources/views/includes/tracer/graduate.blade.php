<section class="container-width mx-auto">
    <x-heading text="Alumni Profile" />

    @php
        Auth::check() ? $hasValues = [1, 1, 1, 1, 1] : $hasValues = [0, 0, 0, 0, 0];
        Auth::check() ? $values = ['', '', '', '', ''] : $values = ['', '', '', '', ''];

        $icons = ['fa-tag', 'fa-tag', 'fa-tag', 'fa-cake-candles', 'fa-graduation-cap'];
        $ids = ['first-name', 'middle-name', 'last-name', 'birth-date', 'year-graduated'];
        $labels = ['First Name (Required)', 'Middle Name', 'Last Name (Required)', 'Birth Date (Required)', 'Year Graduated (Required)'];
        $names = ['first_name', 'middle_name', 'last_name', 'birth_date', 'year_graduated'];
        $placeholders = ['e.g. John', 'e.g. Jane', 'e.g. Doe', '', 'e.g. ' . date('Y')];
        $types = ['text', 'text', 'text', 'date', 'year'];
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
            
            @error($names[$i])
                <x-error-message :message="$message" />
            @enderror
        </div>
    @endfor

    @php
        $displayTexts = [
            ['Male', 'Female'],
            $programs
        ];

        $icons = ['fa-mars-and-venus', 'fa-building-columns'];
        $ids = ['gender', 'programs'];
        $labels = ['Gender (Required)', 'Programs (Required)'];
        $loops = [2, count($programs)];
        $specials = ['', 'programs'];

        $values = [
            ['Male', 'Female'],
            $programs
        ]
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

            @error($ids[$i])
                <x-error-message :message="$message" />
            @enderror
        </div>
    @endfor
</section>