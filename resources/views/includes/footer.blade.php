<footer class="bg-red-900 container-spacing text-white">
    <div class="gap-5 grid @if (Auth::check()) xl:grid-cols-5 xl:text-left @else lg:grid-cols-4 lg:text-left @endif max-w-screen-2xl mx-auto text-center">
        <section class="font-montserrat text-center">
            <img
                alt="CSU Logo"
                class="inline-block w-20"
                src="{{ asset('images/icons/logo.png') }}"
            >

            <h2 class="font-black text-3xl">CSUAN AKO</h2>
            <h3 class="font-thin text-xs">AN ONLINE ALUMNI REPOSITORY</h3>
        </section>

        <section>
            <h2 class="font-black font-montserrat text-xl">HOME LINKS</h2>

            <ul class="mt-3">
                @php
                    $homepage_links = [
                        route('home') . '#do',
                        route('home') . '#organization',
                        route('home') . '#contact'
                    ];

                    $homepage_links_texts = ['What We Do', 'Alumni Organization', 'Contact Us'];
                @endphp

                @for ($i = 0; $i < count($homepage_links); $i++)
                    <li class="mt-1">
                        <a class="hover:underline" href="{{ $homepage_links[$i] }}">{{ $homepage_links_texts[$i] }}</a>
                    </li>
                @endfor
            </ul>
        </section>

        <section>
            <h2 class="font-black font-montserrat text-xl">INTERNAL LINKS</h2>

            <ul class="mt-3">
                @php
                    $internal_links = [
                        route('home'),
                        route('directory'),
                        route('privacy'),
                        route('terms')
                    ];

                    $internal_links_texts = [
                        'Home',
                        'Directory',
                        'Privacy Notice',
                        'Terms of Use'
                    ];
                @endphp

                @for ($i = 0; $i < count($internal_links); $i++)
                    <li class="mt-1">
                        <a class="hover:underline" href="{{ $internal_links[$i] }}">{{ $internal_links_texts[$i] }}</a>
                    </li>
                @endfor

                @if (!Auth::check())
                    <li class="mt-1">
                        <a class="hover:underline" href="{{ route('login') }}">Login</a>
                    </li>

                    <li class="mt-1">
                        <a class="hover:underline" href="{{ route('register') }}">Register</a>
                    </li>

                    <li class="mt-1">
                        <a class="hover:underline" href="{{ route('password.request') }}">Forgot Password</a>
                    </li>
                @endif
            </ul>
        </section>

        @if (Auth::check())
            <section>
                <h2 class="font-black font-montserrat text-xl">TRACER LINKS</h2>

                <ul class="mt-3">
                    <li class="mt-1">
                        <a class="hover:underline" href="{{ route('tracerGraduate') }}">Graduate Profile</a>
                    </li>
                    
                    <li class="mt-1">
                        <a class="hover:underline" href="{{ route('tracerEmployment') }}">Employment Data</a>
                    </li>

                    @if (empty(Auth::user()->graduate->feedback))
                        <li class="mt-1">
                            <a class="hover:underline" href="{{ route('tracerFeedback') }}">University Feedback</a>
                        </li>
                    @endif

                    <li class="mt-1">
                        <a class="hover:underline" href="{{ route('tracerAccount') }}">My Account</a>
                    </li>
                </ul>
            </section>
        @endif

        <section>
            <h2 class="font-black font-montserrat text-xl">EXTERNAL LINKS</h2>

            <ul class="mt-3">
                @php
                    $external_links = [
                        'https://www.csu.edu.ph',
                        'https://aparri.csu.edu.ph',
                        'https://portal.csu.edu.ph',
                        'https://www.facebook.com/cagayanstate'
                    ];

                    $external_links_texts = [
                        'CSU Official Website',
                        'CSU Aparri Website',
                        'CSU Enrollment Portal',
                        'Office of the President CSU'
                    ];
                @endphp

                @for ($i = 0; $i < count($external_links); $i++)
                    <li class="mt-1">
                        <a class="hover:underline" href="{{ $external_links[$i] }}" target="_BLANK">{{ $external_links_texts[$i] }}</a>
                    </li>
                @endfor
            </ul>
        </section>
    </div>
</footer>