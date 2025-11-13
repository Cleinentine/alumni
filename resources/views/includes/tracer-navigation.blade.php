<nav class="bg-red-900 border-t-2 border-t-yellow-400 grid @if (Auth::user()->graduate->feedback) grid-cols-4 @else grid-cols-3 @endif fixed lg:top-[51px] text-center top-[63px] w-full z-30">
    <div>
        <a class="block duration-500 hover:bg-yellow-400 hover:text-black p-5 text-white" href="{{ route('tracerGraduate') }}">
            <span><i class="fa-solid fa-user-graduate"></i></span>
            <span class="font-light hidden md:block mt-1 text-xs">GRADUATE</span>
        </a>
    </div>

    <div>
        <a class="block duration-500 hover:bg-yellow-400 hover:text-black p-5 text-white" href="{{ route('tracerEmployment') }}">
            <span><i class="fa-solid fa-user-tie"></i></span>
            <span class="font-light hidden md:block mt-1 text-xs">EMPLOYMENT</span>
        </a>
    </div>

    @if (Auth::user()->graduate->feedback)
        <div>
            <a class="block duration-500 hover:bg-yellow-400 hover:text-black p-5 text-white" href="{{ route('tracerFeedback') }}">
                <span><i class="fa-solid fa-building-columns"></i></span>
                <span class="font-light hidden md:block mt-1 text-xs">FEEDBACK</span>
            </a>
        </div>
    @endif

    <div>
        <a class="block duration-500 hover:bg-yellow-400 hover:text-black p-5 text-white" href="{{ route('tracerAccount') }}">
            <span><i class="fa-solid fa-user-cog"></i></span>
            <span class="font-light hidden md:block mt-1 text-xs">ACCOUNT</span>
        </a>
    </div>
</nav>