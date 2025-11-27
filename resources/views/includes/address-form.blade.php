<section id="address-form">
    <div class="mt-10">
        <x-label for="country" text="Country (Required)" />

        <x-select
            :displayText="$countries"
            icon="fa-globe"
            id="country"
            :loop="count($countries)"
            name="country"
            :selected="$selectedCountry"
            special="country"
            :value="$countries"
        />

        @error('country')
            <x-error-message :message="$message" />
        @enderror
    </div>

    <div class="mt-10">
        <x-label for="State" text="State" />

        <div class="relative">
            <select
                class="border-3 border-red-900 cursor-pointer outline-none pl-[50px] placeholder:italic px-7 py-3.5 rounded-md text-lg w-full"
                id="state"
                name="state"
            >
                <option value="">-- Select --</option>

                @if (Auth::check() && $selectedState)
                    @foreach ($states as $state)
                        <option @if ($selectedState == $state['id']) selected @endif value="{{ $state['id'] }}">{{ $state['name'] }}</option>
                    @endforeach
                @endif
            </select>

            <span class="absolute left-5 pointer-events-none select-none text-red-900 text-lg top-4">
                <i class="fa-solid fa-flag-usa"></i>
            </span>
        </div>

        @error('state')
            <x-error-message :message="$message" />
        @enderror
    </div>

    <div class="mt-10">
        <x-label for="City" text="City" />

        <div class="relative">
            <select
                class="border-3 border-red-900 cursor-pointer outline-none pl-[50px] placeholder:italic px-7 py-3.5 rounded-md text-lg w-full"
                id="city"
                name="city"
            >
                <option value="">-- Select --</option>

                @if (Auth::check() && $selectedCity)
                    @foreach ($cities as $city)
                        <option @if ($selectedCity == $city['id']) selected @endif value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                    @endforeach
                @endif
            </select>

            <span class="absolute left-5 pointer-events-none select-none text-red-900 text-lg top-4">
                <i class="fa-solid fa-city"></i>
            </span>
        </div>

        @error('city')
            <x-error-message :message="$message" />
        @enderror
    </div>
</section>

@vite(['resources/js/address-dropdown.js'])