@extends('layouts.app')

@section('content')
    @include('includes.header')

    <article class="bg-cover bg-center bg-no-repeat h-[1000px] md:h-screen relative text-white" style="background-image: url('{{ asset('images/banner.jpeg') }}');">
        <div class="bg-black/70 container-spacing h-full">
                <div class="-translate-x-1/2 -translate-y-1/2 absolute font-montserrat left-1/2 md:text-left text-center top-1/2 w-[85%]">
                    <div class="max-w-screen-2xl mx-auto">
                        <h2 class="font-bold text-lg">WELCOME TO</h2>

                        <h1 class="font-black text-7xl">
                            <span class="text-red-900">CSUAN</span>
                            <span class="text-yellow-400">AKO</span>
                        </h1>

                        <h3 class="font-thin text-lg">AN ONLINE ALUMNI REPOSITORY</h3>

                        <p class="leading-8 lg:w-[70%] md:w-[90%] mt-10 tracking-wide w-full xl:w-1/2">
                            Welcome to the Cagayan State University Alumni Portal — a unified platform designed to keep our vibrant CSU community connected and empowered.
                            Explore the Alumni Directory to reconnect with fellow graduates, access the Tracer System to share your professional journey, and benefit from
                            data-driven insights through our Decision-Support System. Together, we celebrate achievements, strengthen networks, and support the continuous
                            growth of every CSU alumni.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </article>
    
    <article class="container-spacing max-w-screen-2xl mx-auto" id="do">
        <x-heading text="What We Do" />

        <section class="gap-5 grid md:grid-cols-3">
            @for ($i = 0; $i < 3; $i++)
                <div>
                    <div class="bg-red-900/10 border-2 border-red-900/20 hover:border-red-900/40 hover:bg-red-900/20 transition-all duration-300 ease-in-out rounded-lg p-5 h-full">
                        <div class="text-red-900 mb-5 text-6xl">
                            <i class="fa-solid {{ $icon[$i] }}"></i>
                        </div>

                        <h2 class="font-black font-montserrat text-xl mb-3 uppercase">{{ $heading[$i] }}</h2>

                        <p class="leading-8">{{ $description[$i] }}</p>
                    </div>
                </div>
            @endfor
        </section>
    </article>

    <article class="bg-gray-100 container-spacing" id="organization">
        <section class="max-w-screen-2xl mx-auto">
            <x-heading text="Alumni Organization" />

            <div class="gap-5 grid items-center lg:grid-cols-2">
                <section>
                    <h2 class="font-bold font-montserrat text-3xl">CSUAN Ako Alumni Association</h2>

                    <p class="leading-8 my-10 xl:w-[75%]">The CSUAN Ako Alumni Association is a dynamic community of graduates from Cagayan State University, dedicated to fostering lifelong connections, supporting professional growth, and contributing to the university's mission. Our association serves as a platform for networking, collaboration, and engagement among alumni, students, and faculty.</p>

                    <p class="leading-8 mb-10 xl:w-[75%]">Through various events, initiatives, and programs, we aim to strengthen the bond between alumni and the university while promoting the values of excellence, integrity, and service. Join us in celebrating our shared heritage and making a positive impact on our communities.</p>
                </section>

                <section>
                    <img class="rounded-lg shadow-lg" src="{{ asset('images/organization.png') }}" alt="CSUA Alumni Association">
                </section>
            </div>
        </section>
    </article>
    
    <section class="container-spacing" id="contact">
        <div class="max-w-screen-2xl mx-auto">
            <x-heading text="Contact Us" />

            <div class="gap-5 grid md:grid-cols-2">
                <section class="text-center md:text-left">
                    <h2 class="font-bold font-montserrat text-3xl">Have a question?</h2>

                    <p class="leading-8 my-10 xl:w-[75%]">We're here to help! Fill out the form or reach us via email or phone. Our Customer Care Team is available to help you get the best experience out of CSUAn Ako.</p>
                    <p class="leading-8 mb-10 xl:w-[75%]">Everyone gets a personalized response, so please allow 24 hours during business hours for a reply. Our business hours are M-F from 9am to 5pm PST.</p>

                    <contact>
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
                    </contact>
                </section>

                <section>
                    <form action="{{ route('send') }}/#contact" class="font-roboto" method="POST">
                        @csrf
                        @method("POST")
                        @honeypot

                        @for ($i = 0; $i < count($ids); $i++)
                            <div class="mt-10">
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

                        <div class="mt-10">
                            <x-label for="subject" text="Subject (Required)" />

                            <x-select
                                icon="fa-folder-open"
                                id="subject"
                                name="subject"
                                selected=""
                                special=""

                                :displayText="$subjects"
                                :loop="count($subjects)"
                                :value="$subjects"
                            />

                            @error('subject')
                                <x-error-message :message="$message" />
                            @enderror
                        </div>

                        <div class="mt-10">
                            <x-label for="message" text="Message (Required)" />

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
                        
                        @if (session('successMessage'))
                            <div class="mt-10 text-center">
                                <x-success-message :message="session('successMessage')" />
                            </div>
                        @endif
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </section>

    @include('includes.survey-link')
    @include('includes.facebook')
    @include('includes.footer')
@endsection