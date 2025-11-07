<footer class="bg-red-900 container-spacing text-white">
    <div class="gap-5 grid lg:grid-cols-4 max-w-screen-2xl lg:text-left mx-auto text-center">
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
                        route('home') . '#offer',
                        route('home') . '#alumni',
                        route('home') . '#contact',
                        route('home') . '#facebook'
                    ];

                    $homepage_links_texts = ['What We Offer', 'Alumni Organization', 'Contact Us', 'Facebook Pages'];
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
                        '#',
                        '#',
                        '#',
                        '#'
                    ];

                    $internal_links_texts = [
                        'Home',
                        'Directory',
                        'Tracer',
                        'Privacy Policy',
                        'Terms & Conditions'
                    ];
                @endphp

                @for ($i = 0; $i < count($internal_links); $i++)
                    <li class="mt-1">
                        <a class="hover:underline" href="{{ $internal_links[$i] }}">{{ $internal_links_texts[$i] }}</a>
                    </li>
                @endfor
            </ul>
        </section>

        <section>
            <h2 class="font-black font-montserrat text-xl">EXTERNAL LINKS</h2>

            <ul class="mt-3">
                @php
                    $external_links = [
                        'https://www.csu.edu.ph',
                        'https://aparri.csu.edu.ph',
                        'https://www.facebook.com/cagayanstate'
                    ];

                    $external_links_texts = [
                        'CSU Official Website',
                        'CSU Aparri Website',
                        'Office of the President CSU'
                    ];
                @endphp

                @for ($i = 0; $i < count($external_links); $i++)
                    <li class="mt-1">
                        <a class="hover:underline" href="{{ $external_links[$i] }}">{{ $external_links_texts[$i] }}</a>
                    </li>
                @endfor
            </ul>
        </section>
    </div>
</footer>