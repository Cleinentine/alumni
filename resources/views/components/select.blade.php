<div class="relative">
    <select
        class="border-3 border-red-900 cursor-pointer outline-none pl-[60px] placeholder:italic px-10 py-5 rounded-md text-xl w-full"
        id="{{ $id }}"
        name={{ $name }}
    >
        <option value="">-- Select --</option>

        @if (empty($special))
            @for ($i = 0; $i < count($value); $i++)
                <option @if ($selected == $value[$i]) selected @endif value="{{ $value[$i] }}">{{ $displayText[$i] }}</option>
            @endfor
        @else
            @for ($i = 0; $i < count($value); $i++)
                <option @if ($selected == $value[$i]['id']) selected @endif value="{{ $value[$i]['id'] }}">{{ $displayText[$i]['name'] }}</option>
            @endfor
        @endif
    </select>

    <span class="absolute left-5 pointer-events-none select-none text-red-900 text-xl top-5">
        <i class="fa-solid {{ $icon }}"></i>
    </span>
</div>