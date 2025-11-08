<section class="container-width mx-auto">
    <x-heading text="Account Details" />

    @php
        $hasValues = [1, 1, 0, 0];
        $icons = ['fa-at', 'fa-mobile', 'fa-key', 'fa-redo'];
        $ids = ['email', 'contact-number', 'password', 'password-confirmation'];
        $labels = ['Email (Required)', 'Contact Number (Required)', 'Password (Required)', 'Repeat Password (Required)'];
        $names = ['email', 'contact_number', 'password', 'password_confirmation'];
        $placeholders = ['e.g. csuanako@email.com.ph', 'e.g. +631234567890', '', ''];
        $types = ['email', 'text', 'password', 'password'];
        $values = ['', '', '', ''];
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
            
            @error($ids[$i])
                <x-error-message :message="$message" />
            @enderror
        </div>
    @endfor
</section>