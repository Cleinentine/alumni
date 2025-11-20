@extends('layouts.app')

@section('content')
    @include('includes.header')

    <section class="container-spacing max-w-screen-2xl mx-auto">
        <h2 class="font-black font-montserrat lg:text-8xl md:text-7xl md:text-left text-5xl text-center">
            <span class="block">ALUMNI</span>
            <span class="block text-red-900 underline">DIRECTORY</span>
        </h2>

        <form action="{{ route('directory') }}" method="GET">
            @csrf

            @php
                $displayTexts = [
                    ['Last Name A-Z', 'Last Name Z-A'],
                    $colleges,
                    range(1960, date('Y')),
                    ['25', '50', '100', '200', '500']
                ];
                $icons = ['fa-sort', 'fa-building-columns', 'fa-graduation-cap', 'fa-arrow-down-1-9'];
                $labels = ['Sort By Name', 'Filter By College', 'Filter By Year', 'Results per Page'];
                $names = ['sort', 'group', 'year', 'limit'];
                $loops = [count($displayTexts[0]), count($displayTexts[1]), count($displayTexts[2]), count($displayTexts[3])];
                $selected = [$sort, $group, $year, $limit];
                $specials = ['', 'colleges', '', ''];

                $values = [
                    ['asc', 'desc'],
                    $colleges,
                    range(1960, date('Y')),
                    [25, 50, 100, 200, 500]
                ];
            @endphp

            <section class="gap-5 grid md:grid-cols-4 mt-10">
                @for ($i = 0; $i < count($names); $i++)
                    <div>
                        <x-label for="{{ $names[$i] }}" text="{{ $labels[$i] }}" />

                        <x-select
                            :displayText="$displayTexts[$i]"
                            :icon="$icons[$i]"
                            :id="$names[$i]"
                            :loop="$loops[$i]"
                            :name="$names[$i]"
                            :selected="$selected[$i]"
                            :special="$specials[$i]"
                            :value="$values[$i]"
                        />
                    </div>
                @endfor

                <div class="md:col-span-3">
                    <x-input
                        hasValue=1
                        icon="fa-search"
                        id="keywords"
                        name="keywords"
                        placeholder="e.g. John Doe"
                        type="search"
                        value=""
                    />
                </div>

                <div>
                    <button class="bg-red-500 cursor-pointer duration-500 font-bold font-nunito hover:bg-red-600 px-7 py-[14.5px] rounded-md text-lg text-white w-full" type="submit">
                        SEARCH
                        <span><i class="fa-solid fa-search"></i></span>
                    </button>
                </div>
            </section>
        </form>

        <section class="mt-10" id="search">
            @if (count($graduates) < 1)
                <x-warning-textbox
                    :subtext="$subtext"
                    :text="$text"
                />
            @else
                <h2 class="font-black font-montserrat mb-10">SEARCH RESULTS: {{ count($graduates) }} alumni found</h2>

                @foreach ($graduates as $graduate)
                    <div class="border-b-2 border-b-red-900 duration-500 gap-5 grid hover:bg-gray-100 md:grid-cols-2 p-3">
                        <div>
                            <h2 class="font-bold text-2xl">{{ $graduate->last_name . ', ' . $graduate->first_name . ' ' . $graduate->middle_name }}</h2>

                            <div class="mt-5 text-sm uppercase">
                                <h3 class="mt-5">Batch {{ $graduate->year_graduated }}</h3>
                                <h4>College of {{ $graduate->program->college->name }}</h4>
                                <h5>{{ $graduate->program->name }}</h5>
                            </div>
                        </div>

                        <div class="text-xs text-white">
                            @if ($graduate->employment)
                                <h6 class="bg-red-900 inline-block p-3 rounded-md">{{ $graduate->employment->title }}</h6>
                                <h6 class="bg-red-900 inline-block mt-3 p-3 rounded-md">{{ $graduate->employment->industry->name }}</h6>
                            @endif
                        </div>
                    </div>
                @endforeach

                {{ $graduates->links() }}
            @endif
        </section>
    </section>

    @include('includes.survey-link')
    @include('includes.facebook')
    @include('includes.footer')
@endsection