<section class="bg-red-900 h-screen relative text-center text-white">
    <section class="-translate-x-1/2 -translate-y-1/2 absolute left-1/2 top-1/2 w-full">
        <h1 class="font-black font-montserrat text-8xl">{{ $code }}</h1>
        <h2 class="font-bold text-3xl my-5">{{ $text }}</h2>

        <p class="text-lg mb-10">{{ $message }}</p>

        <a href="{{ url('/') }}" class="bg-yellow-500 duration-500 font-bold hover:bg-yellow-600 px-7 py-3 rounded text-black">Go to Homepage</a>
    </section>
</section>