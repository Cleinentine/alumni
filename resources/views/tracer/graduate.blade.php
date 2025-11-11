@extends('layouts.app')

@section('content')
    <section class="container-spacing max-w-screen-2xl mx-auto">
        <x-heading text="Alumni Profile" />

        <div class="text-center">
            @if (session('successMessage'))
                <x-success-message :message="session('successMessage')" />
            @endif
        </div>

        {{ Auth::logout() }}
        
        <form action="{{ route('tracerGraduate') }}" method="POST">
            @csrf

            @php
                !$graduate
                    ? $hasValues = [1, 1, 1, 1, 1]
                    : $hasValues = [0, 0, 0, 0, 0];


                !$graduate
                    ? $values = ['first_name', 'middle_name', 'last_name', 'birth_date', 'year_graduated']
                    : $values = [
                        $graduate->first_name,
                        $graduate->middle_name,
                        $graduate->last_name,
                        $graduate->birth_date,
                        $graduate->year_graduated
                    ];

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
                $displayTexts = [
                    ['Male', 'Female'],
                    $programs
                ];

                $icons = ['fa-mars-and-venus', 'fa-building-columns'];
                $labels = ['Gender (Required)', 'Program (Required)'];
                $loops = [2, count($programs)];
                $names = ['gender', 'programs'];
                $specials = ['', 'programs'];

                if ($graduate) {
                    $selected = [$graduate->gender, $graduate->program_id];
                } else {
                    $selected = ['', ''];
                }

                $values = [
                    ['Male', 'Female'],
                    $programs
                ]
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

            <x-button icon="fa-user-edit" text="Update Profile" />
        </form>
    </section>

    @include('includes.facebook')
    @include('includes.footer')
@endsection