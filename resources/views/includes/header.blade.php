<header class="bg-red-900 fixed lg:py-0 px-5 py-3 text-white w-full z-50">
    <section class="gap-5 grid grid-cols-2 max-w-screen-2xl mx-auto">
        <div>
            <h1>
                <a class="font-black font-montserrat inline-block lg:text-3xl md:text-2xl mt-1.5 text-xl" href="{{ route('home') }}">CSUAN AKO</a>
            </h1>
        </div>

        <nav class="text-right">
            <div class="cursor-pointer inline-block group lg:hidden mt-1.5" id="hamburger">
                <div class="bg-white duration-500 group-hover:bg-yellow-400 h-1 w-10" id="first-bar"></div>
                <div class="bg-white duration-500 group-hover:bg-yellow-400 h-1 my-[7px] w-10" id="second-bar"></div>
                <div class="bg-white duration-500 group-hover:bg-yellow-400 h-1 w-10" id="third-bar"></div>
            </div>

            <ul class="hidden lg:block">
                @if (!Auth::check())
                    <li class="inline">
                        <a class="border-t-3 border-transparent duration-500 font-bold hover:border-yellow-400 inline-block p-3" href="{{ route('login') }}">
                            LOGIN
                            <span><i class="fa-solid fa-right-to-bracket"></i></span>
                        </a>
                    </li>
                @else
                    @if (Auth::user()->roles <= 2)
                        <li class="inline">
                            <a class="border-t-3 border-transparent duration-500 font-bold hover:border-yellow-400 inline-block p-3" href="/admin">
                                ADMIN
                                <span><i class="fa-solid fa-gauge-high"></i></span>
                            </a>
                        </li>
                    @else
                        <li class="inline">
                            <a class="border-t-3 border-transparent duration-500 font-bold hover:border-yellow-400 inline-block p-3" href="{{ route('tracerGraduate') }}">
                                TRACER
                                <span><i class="fa-solid fa-address-book"></i></span>
                            </a>
                        </li>
                    @endif
                @endif

                <li class="inline">
                    <a class="border-t-3 border-transparent duration-500 font-bold hover:border-yellow-400 inline-block p-3" href="{{ route('directory') }}">
                        DIRECTORY
                        <span><i class="fa-solid fa-search"></i></span>
                    </a>
                </li>

                @if (Auth::check())
                    <form action="{{ route('home') }}" class="inline" method="POST">
                        @csrf
                        @method("PUT")

                        <button class="border-t-3 border-transparent cursor-pointer duration-500 font-bold hover:border-yellow-400 p-3" type="submit">
                            SIGN-OUT
                            <span><i class="fa-solid fa-right-from-bracket"></i></span>
                        </button>
                    </form>
                @endif
            </ul>
        </nav>
    </section>
</header>

<nav class="-top-100 bg-red-900 border-t-2 border-t-yellow-400 duration-500 fixed lg:hidden py-5 w-full z-40" id="mobile-nav">
    <ul>
        <li>
            <a class="flex duration-500 hover:bg-yellow-400 hover:text-black p-5 text-white" href="{{ route('home') }}">
                <span class="w-[10%]"><i class="fa-solid fa-house"></i></span>
                <span class="font-bold w-[90%]">Home</span>
            </a>
        </li>

        <li>
            <a class="flex duration-500 hover:bg-yellow-400 hover:text-black p-5 text-white" href="{{ route('directory') }}">
                <span class="w-[10%]"><i class="fa-solid fa-search"></i></span>
                <span class="font-bold w-[90%]">Directory</span>
            </a>
        </li>

        @if (Auth::check())
            @if (Auth::user()->roles <= 2)
                <li>
                    <a class="flex duration-500 hover:bg-yellow-400 hover:text-black p-5 text-white" href="/admin">
                        <span class="w-[10%]"><i class="fa-solid fa-gauge-high"></i></span>
                        <span class="font-bold w-[90%]">Admin</span>
                    </a>
                </li>
            @else
                <li>
                    <a class="flex duration-500 hover:bg-yellow-400 hover:text-black p-5 text-white" href="{{ route('tracerGraduate') }}">
                        <span class="w-[10%]"><i class="fa-solid fa-address-book"></i></span>
                        <span class="font-bold w-[90%]">Tracer</span>
                    </a>
                </li>
            @endif
        @else
            @php
                $icons = ['fa-right-to-bracket', 'fa-user-plus', 'fa-paper-plane'];
                $links = [route('login'), route('register'), route('password.request')];
                $texts = ['Login', 'Register', 'Forgot Password'];
            @endphp

            @for ($i = 0; $i < count($links); $i++)
                <li>
                    <a class="flex duration-500 hover:bg-yellow-400 hover:text-black p-5 text-white" href="{{ $links[$i] }}">
                        <span class="w-[10%]"><i class="fa-solid {{ $icons[$i] }}"></i></span>
                        <span class="font-bold w-[90%]">{{ $texts[$i] }}</span>
                    </a>
                </li>
            @endfor
        @endif
    </ul>

    @if (Auth::check())
        <hr class="border-yellow-400 my-5">

        <form action="{{ route('home') }}" method="POST">
            @csrf
            @method("PUT")

            <button class="cursor-pointer duration-500 hover:bg-yellow-400 hover:text-black flex p-5 text-left text-white w-full" type="submit">
                <span class="w-[10%]"><i class="fa-solid fa-right-from-bracket"></i></span>
                <span class="font-bold w-[90%]">Logout</span>
            </button>
        </form>
    @endif
</nav>

<script>
    const hamburger = document.getElementById("hamburger"),
        first_bar = document.getElementById("first-bar"),
        second_bar = document.getElementById("second-bar"),
        third_bar = document.getElementById("third-bar"),
        mobile_nav = document.getElementById("mobile-nav");

    hamburger.addEventListener("click", function() {
        first_bar.classList.toggle("bg-yellow-400");
        second_bar.classList.toggle("bg-yellow-400");
        third_bar.classList.toggle("bg-yellow-400");

        first_bar.classList.toggle("w-[45px]");
        third_bar.classList.toggle("w-[50px]");

        mobile_nav.classList.toggle("top-[63px]");
    });
</script>