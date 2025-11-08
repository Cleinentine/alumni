<section class="container-width mx-auto">
    <x-heading text="Employment Data" />

    @php
        Auth::check() ? $hasValues = [1, 1, 1] : $hasValues = [0, 0, 0];
        Auth::check() ? $values = ['', '', ''] : $values = ['', '', ''];

        $icons = ['fa-user-tie', 'fa-building', 'fa-calendar-days'];
        $ids = ['title', 'company', 'time-to-first-job'];
        $labels = ['Title', 'Company', 'Months before First Job'];
        $names = ['title', 'company', 'time_to_first_job'];
        $placeholders = ['e.g. Chief Executive Officer', 'e.g. Cagayan State University', 'e.g. 9'];
        $types = ['text', 'text', 'number'];
    @endphp

    @for ($i = 0; $i < count($ids); $i++)
        <div class="mt-5">
            <x-label for="{{ $ids[$i] }}" text="{{ $labels[$i] }}" />

            <x-input
                :hasValue="$hasValues[$i]"
                :icon="$icons[$i]"
                :id="$ids[$i]"
                :name="$names[$i]"
                :placeholder="$placeholders[$i]"
                :type="$types[$i]"
                :value="$values[$i]"
            />
            
            @error($names[$i])
                <x-error-message :message="$message" />
            @enderror
        </div>
    @endfor

    @php
        $displayTexts = [
            [''],
            ['Full-time', 'Part-time', 'Temporary/Seasonal', 'Contract', 'Intern/Trainee', 'Self-Employed', 'Independent Contractor', 'Freelancer', 'Volunteer', 'Unemployed'],
            $industries,
            ['JobStreet', 'LinkedIn', 'Indeed', 'Kalibrr', 'PhilJobNet', 'Others']

        ];

        $icons = ['fa-bars-progress', 'fa-person-walking-luggage', 'fa-industry', 'fa-magnifying-glass'];
        $ids = ['progression', 'status', 'industry', 'search-methods'];
        $labels = ['Progression', 'Status (Required)', 'Industry', 'Search Methods'];
        $loops = [1, count($displayTexts[1]), count($industries), count($displayTexts[3])];
        $names = ['progression', 'status', 'industry', 'search_methods'];
        $specials = ['', '', 'industries', ''];
    @endphp

    @for ($i = 0; $i < count($ids); $i++)
        <div class="mt-5">
            <x-label for="{{ $ids[$i] }}" text="{{ $labels[$i] }}" />

            <x-select
                :displayText="$displayTexts[$i]"
                :icon="$icons[$i]"
                :id="$ids[$i]"
                :loop="$loops[$i]"
                :name="$ids[$i]"
                :special="$specials[$i]"
                :value="$displayTexts[$i]"
            />

            @error($names[$i])
                <x-error-message :message="$message" />
            @enderror
        </div>
    @endfor

    <div class="mt-5" id="unemployed">
        <x-label for="unemployment" text="Unemployment Reasons" />
        
        <x-textbox
            id="unemployment"
            name="unemployment"
            placeholder="e.g. No Work"
        />
    </div>
</section>

<script>
    const unemployed = document.getElementById("unemployed"),
        status = document.getElementById("status"),
        unemployment = document.getElementById("unemployment");

    if (status.value !== "Unemployed") {
        unemployed.style.display = "none";
    } else {
        unemployed.style.display = "block";
    }

    status.addEventListener("change", function() {
        if (status.value == "Unemployed") {
            unemployed.style.display = "block";
        } else {
            unemployed.style.display = "none";
            unemployment.value = "";
        }
    });
</script>