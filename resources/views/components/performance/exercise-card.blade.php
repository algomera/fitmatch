@props(['item' => null, 'color' => null, 'intensity' => null])
<div
    class="m-1 select-none border border-b-4 rounded-md overflow-hidden h-40 min-h-[10rem] w-80 shrink-0"
    style="border-bottom-color: {{ $color }}"
>
    <div class="w-full h-full items-center justify-center bg-white">
        <div class="flex flex-col justify-center h-full p-4">
            <span class="text-xs font-fit-bold text-fit-magenta mb-2">{{ $intensity?->name }}</span>
            <p class="text-xs text-fit-black">
                {{ $item->area->name }}/{{ $item->zone->name }}
            </p>
            <h3 class="truncate my-1.5">{{ $item->name }}</h3>
            <p class="text-sm text-fit-dark-gray line-clamp-2">{{ $item->description }}</p>
        </div>
    </div>
</div>
