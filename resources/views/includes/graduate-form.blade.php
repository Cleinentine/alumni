@php
    $icons = ['fa-tag', 'fa-tag', 'fa-tag', 'fa-cake-candles', 'fa-graduation-cap'];
    $labels = ['First Name (Required)', 'Middle Name', 'Last Name (Required)', 'Birth Date (Required)', 'Year Graduated (Required)'];
    $names = ['first_name', 'middle_name', 'last_name', 'birth_date', 'year_graduated'];
    $placeholders = ['e.g. John', 'e.g. Jane', 'e.g. Doe', '', 'e.g. ' . date('Y')];
    $types = ['text', 'text', 'text', 'date', 'year'];
@endphp

@for ($i = 0; $i < count($names); $i++)
    <div class="mt-10">
        <x-label for="{{ $names[$i] }}" text="{{ $labels[$i] }}" />

        <x-input
            :hasValue="$hasValues[$i]"
            :icon="$icons[$i]"
            :id="$names[$i]"
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
    $icons = ['fa-mars-and-venus', 'fa-building-columns'];
    $labels = ['Gender (Required)', 'Program (Required)'];
    $loops = [2, count($programs)];
    $names = ['gender', 'programs'];
    $specials = ['', 'programs'];

    $values = [
        ['Male', 'Female'],
        $programs
    ]
@endphp

@for ($i = 0; $i < count($names); $i++)
    <div class="mt-10">
        <x-label for="{{ $names[$i] }}" text="{{ $labels[$i] }}" />

        <x-select
            :displayText="$values[$i]"
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

@php
    if (Auth::check() && Auth::user()->roles >= 4) {
        $selectedCity = $graduate->city_id;
        $selectedCountry = $graduate->country_id;
        $selectedState = $graduate->state_id;
    } else {
        $selectedCity = '';
        $selectedCountry = '';
        $selectedState = '';
    }
@endphp

@include('includes.address-form')