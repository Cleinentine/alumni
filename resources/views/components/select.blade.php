<div class="relative">
    <select
        class="border-2 border-red-900 cursor-pointer outline-none pl-[50px] placeholder:italic px-7 py-3 rounded-md text-sm w-full"
        id="{{ $id }}"
        name={{ $name }}
    >
        <option value="">-- Select --</option>

        @if (empty($special))
            @for ($i = 0; $i < count($value); $i++)
                <option value="{{ $value[$i] }}">{{ $displayText[$i] }}</option>
            @endfor
        @else
            @for ($i = 0; $i < count($value); $i++)
                <option value="{{ $value[$i]['id'] }}">{{ $displayText[$i]['name'] }}</option>
            @endfor
        @endif
    </select>

    <span class="absolute left-5 pointer-events-none select-none text-red-900 top-3">
        <i class="fa-solid {{ $icon }}"></i>
    </span>
</div>