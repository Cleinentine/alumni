<nav class="bg-red-900 border-t-2 border-t-yellow-400 fixed lg:top-[51px] text-center top-[63px] w-full z-30">
    <section class="grid @if (empty(Auth::user()->graduate->feedback)) grid-cols-4 @else grid-cols-3 @endif max-w-screen-2xl mx-auto">
        <div>
            <a class="block duration-500 hover:bg-yellow-400 hover:text-black p-5 text-white" href="{{ route('tracerGraduate') }}" id="tracer-graduate">
                <span><i class="fa-solid fa-user-graduate"></i></span>
                <span class="font-light hidden md:block mt-1 text-xs">GRADUATE</span>
            </a>
        </div>

        <div>
            <a class="block duration-500 hover:bg-yellow-400 hover:text-black p-5 text-white" href="{{ route('tracerEmployment') }}" id="tracer-employment">
                <span><i class="fa-solid fa-user-tie"></i></span>
                <span class="font-light hidden md:block mt-1 text-xs">EMPLOYMENT</span>
            </a>
        </div>

        @if (empty(Auth::user()->graduate->feedback))
            <div>
                <a class="block duration-500 hover:bg-yellow-400 hover:text-black p-5 text-white" href="{{ route('tracerFeedback') }}" id="tracer-feedback">
                    <span><i class="fa-solid fa-building-columns"></i></span>
                    <span class="font-light hidden md:block mt-1 text-xs">FEEDBACK</span>
                </a>
            </div>
        @endif

        <div>
            <a class="block duration-500 hover:bg-yellow-400 hover:text-black p-5 text-white" href="{{ route('tracerAccount') }}" id="tracer-account">
                <span><i class="fa-solid fa-user-cog"></i></span>
                <span class="font-light hidden md:block mt-1 text-xs">ACCOUNT</span>
            </a>
        </div>
    </section>
</nav>