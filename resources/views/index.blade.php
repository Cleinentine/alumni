@extends('layouts.app')

@section('content')
    <section class="container-spacing" id="contact">
        <section class="max-w-screen-2xl mx-auto">
            <x-guest-heading text="Contact Us" />

            <section class="gap-5 grid md:grid-cols-2">
                <div class="text-center md:text-left">
                    <h2 class="font-bold font-montserrat text-3xl">Have a question?</h2>

                    <p class="leading-8 my-10 xl:w-[75%]">We're here to help! Fill out the form or reach us via email or phone. Our Customer Care Team is available to help you get the best experience out of CSUAn Ako.</p>
                    <p class="leading-8 mb-10 xl:w-[75%]">Everyone gets a personalized response, so please allow 24 hours during business hours for a reply. Our business hours are M-F from 9am to 5pm PST.</p>

                    @php
                        $contact_headings = ['Address', 'Contact Email', 'Contact Numbers'];
                        $contact_icons = ['fa-map-location-dot', 'fa-at', 'fa-phone'];
                        $contact_details = ['Maura, Aparri, Cagayan, 3515', $contact->contact_email, $contact->contact_number];
                    @endphp

                    @for ($i = 0; $i < count($contact_details); $i++)
                        <h2 class="font-bold font-montserrat @if ($i == 1) mt-5 @endif uppercase">
                            <span>
                                <i class="fa-solid {{ $contact_icons[$i] }}"></i>
                            </span>

                            {{ $contact_headings[$i] }}
                        </h2>

                        @if ($i == 1)
                            <h3 class="mb-5">
                                <a class="font-bold hover:underline text-red-900" href="mailto:{{ $contact_details[$i] }}">{{ $contact_details[$i] }}</a>
                            </h3>
                        @elseif ($i >= 2)
                            <h3>
                                <a class="font-bold hover:underline text-red-900" href="tel:{{ $contact_details[$i] }}">
                                    {{ $contact_details[$i] }}
                                </a>

                                ||

                                <a class="font-bold hover:underline text-red-900" href="tel:{{ $contact->alternate_contact_number }}">
                                    {{ $contact->alternate_contact_number }}
                                </a>
                            </h3>
                        @else
                            <h3>{{ $contact_details[$i] }}</h3>
                        @endif
                    @endfor
                </div>

                <div>
                    <form action="{{ route('sendMessage') }}/#contact" class="font-roboto" method="POST">
                        @csrf
                        @method("POST")

                        @php
                            $hasValues = [0, 0];
                            $icons = ['fa-tag', 'fa-at'];
                            $ids = ['name', 'email'];
                            $labels = ['Name', 'Email'];
                            $placeholders = ['e.g. John Smith', 'e.g. csuanako@email.com.ph'];
                            $types = ['text', 'email'];
                            $values = ['', ''];
                        @endphp

                        @for ($i = 0; $i < count($ids); $i++)
                            <div class="mt-5">
                                <x-label for="{{ $ids[$i] }}" text="{{ $labels[$i] }}" />

                                <x-input
                                    :hasValue="$hasValues[$i]"
                                    :icon="$icons[$i]"
                                    :id="$ids[$i]"
                                    :name="$ids[$i]"
                                    :placeholder="$placeholders[$i]"
                                    :type="$types[$i]"
                                    :value="$values[$i]"
                                />
                                
                                @error($ids[$i])
                                    <x-error-message :message="$message" />
                                @enderror
                            </div>
                        @endfor

                        <div class="mt-5">
                            @php
                                $subjects = [
                                    'Bug Report',
                                    'Directory',
                                    'Registration',
                                    'Tracer',
                                    'Other'
                                ];
                            @endphp

                            <x-label for="subject" text="Subject" />

                            <x-select
                                icon="fa-folder-open"
                                id="subject"
                                name="subject"

                                :displayText="$subjects"
                                :loop="count($subjects)"
                                :value="$subjects"
                            />

                            @error('subject')
                                <x-error-message :message="$message" />
                            @enderror
                        </div>

                        <div class="mt-5">
                            <x-label for="message" text="Message" />

                            <x-textbox
                                id="message"
                                name="message"
                                placeholder="e.g. Hello World!"
                            />

                            @error('message')
                                <x-error-message :message="$message" />
                            @enderror
                        </div>

                        <x-button icon="fa-paper-plane" text="Send Message" />
                    </form>
                </div>
            </section>
        </section>
    </section>

    @include('includes.socials')
    @include('includes.footer')
@endsection