@php
    !Auth::check()
        ? $hasValues = [1, 1, 0, 0]
        : $hasValues = [0, 0, 0, 0];

    !Auth::check()
        ? $values = ['email', 'contact_number', '', '']
        : $values = [Auth::user()->email, Auth::user()->phone, '', ''];

    $icons = ['fa-at', 'fa-mobile', 'fa-key', 'fa-redo'];
    $labels = ['Email', 'Phone', 'Password', 'Repeat Password'];
    $names = ['email', 'phone', 'password', 'password_confirmation'];
    $placeholders = ['e.g. csuanako@email.com.ph', 'e.g. +631234567890', '', ''];
    $types = ['email', 'text', 'password', 'password'];
@endphp

@for ($i = 0; $i < count($names); $i++)
    <div class="mt-10">
        <x-label for="{{ $names[$i] }}" text="{{ $labels[$i] }}" />

        <x-input
            :hasValue="$hasValues[$i]"
            :icon="$icons[$i]"
            :id="$names[$i]"
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

@vite(['resources/js/password-text.js'])