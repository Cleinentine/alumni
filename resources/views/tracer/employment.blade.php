@extends('layouts.app')

@section('content')
    @include('includes.header')
    @include('includes.tracer-navigation')
    
    <section class="relative top-[120px]">
        <section class="container-spacing container-width max-w-screen-2xl mx-auto">
            <x-heading text="Employment Data" />

            <div class="text-center">
                @if (session('successMessage'))
                    <x-success-message :message="session('successMessage')" />
                @endif
            </div>
            
            <form action="{{ route('tracerEmployment') }}" method="POST">
                @csrf

                @php
                    !$employment
                        ? $hasValues = [1, 1, 1]
                        : $hasValues = [0, 0, 0];

                    !$employment
                        ? $values = ['title', 'company', 'time_to_first_job']
                        : $values = [$employment->title, $employment->company, $employment->time_to_first_job];

                    $icons = ['fa-user-tie', 'fa-building', 'fa-calendar-days'];
                    $labels = ['Job Title', 'Company Name', 'Months before your First Job'];
                    $names = ['title', 'company', 'time_to_first_job'];
                    $placeholders = ['e.g. Chief Executive Officer', 'e.g. Cagayan State University', 'e.g. 9'];
                    $types = ['text', 'text', 'number'];
                @endphp

                <div id="employment-form-01">
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
                </div>

                @php
                    $displayTexts = [
                        ['Full-time', 'Part-time', 'Temporary/Seasonal', 'Self-Employed', 'Unemployed'],
                        $industries,
                        ['JobStreet', 'LinkedIn', 'Indeed', 'Kalibrr', 'PhilJobNet', 'Others']

                    ];

                    $ids = ['status-id', 'industries-id', 'search-methods-id'];
                    $icons = ['fa-person-walking-luggage', 'fa-industry', 'fa-magnifying-glass'];
                    $labels = ['Employment Status (Required)', 'Company Industry', 'Job Search Methods'];
                    $loops = [count($displayTexts[0]), count($industries), count($displayTexts[2])];
                    $names = ['status', 'industry', 'search_methods'];

                    if ($employment) {
                        $selected = [$employment->status, $employment->industry_id, $employment->search_methods];
                    } else {
                        $selected = ['', '', ''];
                    }

                    $specials = ['', 'industries', ''];
                @endphp

                @for ($i = 0; $i < count($names); $i++)
                    <div class="mt-10" id="{{ $ids[$i] }}">
                        <x-label for="{{ $names[$i] }}" text="{{ $labels[$i] }}" />

                        <x-select
                            :displayText="$displayTexts[$i]"
                            :icon="$icons[$i]"
                            :id="$names[$i]"
                            :loop="$loops[$i]"
                            :name="$names[$i]"
                            :selected="$selected[$i]"
                            :special="$specials[$i]"
                            :value="$displayTexts[$i]"
                        />

                        @error($names[$i])
                            <x-error-message :message="$message" />
                        @enderror
                    </div>
                @endfor

                @php
                    $selectedCity = $employment->city_id;
                    $selectedCountry = $employment->country_id;
                    $selectedState = $employment->state_id;
                @endphp

                @include('includes.address-form')

                <div class="mt-10" id="unemployed">
                    <x-label for="unemployment" text="Unemployment Reasons" />
                    
                    <x-textbox
                        id="unemployment"
                        name="unemployment"
                        placeholder="e.g. No Work"
                    />
                </div>

                <x-button icon="fa-user-edit" text="Update Employment" />
            </form>
        </section>

        @include('includes.survey-link')
        @include('includes.facebook')
        @include('includes.footer')
    </section>

    <script>
        document.getElementById("tracer-employment").classList.toggle("bg-yellow-400");
        document.getElementById("tracer-employment").style.color = "#000";

        const unemployed = document.getElementById("unemployed"),
            status = document.getElementById("status"),
            unemployment = document.getElementById("unemployment"),

            employment_form_01 = document.getElementById("employment-form-01"),
            industries = document.getElementById("industries-id"),
            search_methods = document.getElementById("search-methods-id"),
            address_form = document.getElementById("address-form");

        if (status.value !== "Unemployed") {
            unemployed.style.display = "none";
        } else {
            unemployed.style.display = "block";
        }

        status.addEventListener("change", function() {
            if (status.value == "Unemployed") {
                unemployed.style.display = "block";

                employment_form_01.style.display = "none";
                industries.style.display = "none";
                search_methods.style.display = "none";
                address_form.style.display = "none";
            } else {
                unemployed.style.display = "none";
                unemployment.value = "";

                employment_form_01.style.display = "block";
                industries.style.display = "block";
                search_methods.style.display = "block";
                address_form.style.display = "block";
            }
        });
    </script>
@endsection