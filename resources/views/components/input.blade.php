<div class="relative">
    <input
        class="border-2 border-red-900 outline-none pl-[50px] placeholder:italic px-7 py-3 rounded-md text-sm w-full"

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

    <span class="absolute left-5 pointer-events-none select-none text-red-900 top-3">
        <i class="fa-solid {{ $icon }}"></i>
    </span>
</div>