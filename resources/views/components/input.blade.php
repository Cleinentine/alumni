<div class="relative">
    <input
        class="border-3 border-red-900 @if ($type == 'date') cursor-pointer @endif outline-none pl-[60px] placeholder:italic px-10 py-5 rounded-md text-xl w-full"

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

    <span class="absolute left-5 pointer-events-none select-none text-red-900 text-xl top-6">
        <i class="fa-solid {{ $icon }}"></i>
    </span>

    @if ($type == "password" && $name == "password")
        <span class="absolute cursor-pointer right-5 text-red-900 text-xl top-6" id="eye-open">
            <i class="fa-solid fa-eye"></i>
        </span>

        <span class="absolute cursor-pointer right-5 text-red-900 text-xl top-6" id="eye-close">
            <i class="fa-solid fa-eye-slash"></i>
        </span>
    @endif
</div>