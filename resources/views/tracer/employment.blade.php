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

                @for ($i = 0; $i < count($selectNames); $i++)
                    <div class="mt-10" id="{{ $ids[$i] }}">
                        <x-label for="{{ $selectNames[$i] }}" text="{{ $selectLabels[$i] }}" />

                        <x-select
                            :displayText="$displayTexts[$i]"
                            :icon="$selectIcons[$i]"
                            :id="$selectNames[$i]"
                            :loop="$loops[$i]"
                            :name="$selectNames[$i]"
                            :selected="$selected[$i]"
                            :special="$specials[$i]"
                            :value="$displayTexts[$i]"
                        />

                        @error($selectNames[$i])
                            <x-error-message :message="$message" />
                        @enderror
                    </div>
                @endfor

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
        @vite(['app/js/address-dropdown-selectr.js'])
    </section>
@endsection