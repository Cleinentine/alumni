<div class="relative">
    <input
        class="border-3 border-red-900 @if ($type == 'date') cursor-pointer @endif outline-none pl-[50px] placeholder:italic px-7 py-3 rounded-md text-lg w-full"

        id="{{ $id }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        type="{{ $type }}"

        @if ($hasValue == 1)
            value="{{ old($name) }}"
        @else
            value="{{ $value }}"
        @endif
    >

    <span class="absolute left-5 pointer-events-none select-none text-red-900 text-lg top-4">
        <i class="fa-solid {{ $icon }}"></i>
    </span>

    @if ($type == "password" && $name == "password")
        <span class="absolute cursor-pointer right-5 text-red-900 text-xl top-4" id="eye-open">
            <i class="fa-solid fa-eye"></i>
        </span>

        <span class="absolute cursor-pointer right-5 text-red-900 text-xl top-4" id="eye-close">
            <i class="fa-solid fa-eye-slash"></i>
        </span>
    @endif
</div>