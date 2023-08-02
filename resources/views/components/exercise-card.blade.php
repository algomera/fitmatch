@props(['exercise'])

<div class="border border-b-4 border-b-fit-magenta rounded-md overflow-hidden w-80">
    <div class="w-full flex items-center justify-between bg-fit-lighter-gray p-4">
        <span class="text-xs font-bold text-fit-magenta">???</span>
        <div class="flex space-x-2">
            <x-heroicon-o-play-circle
                class="h-4 w-4 hover:text-fit-magenta hover:cursor-pointer"></x-heroicon-o-play-circle>
            <x-heroicon-o-heart class="h-4 w-4 hover:text-fit-magenta hover:cursor-pointer"></x-heroicon-o-heart>
        </div>
    </div>
    <div class="w-full items-center justify-center bg-white space-y-1.5">
        <div class="p-4">
            <p class="text-xs text-fit-black">{{ $exercise->area->name }}/{{ $exercise->zone->name }}</p>
            <h4 class="text-2xl font-bold truncate">{{ $exercise->name }}</h4>
            <p class="text-fit-dark-gray line-clamp-2">{{ $exercise->description }}</p>
        </div>
        <div class="border-t w-full flex items-center justify-between p-4">
            <x-heroicon-o-queue-list
                class="h-4 w-4 hover:text-fit-magenta hover:cursor-pointer"></x-heroicon-o-queue-list>
            <div class="flex space-x-2">
                <x-heroicon-o-trash
                    class="h-4 w-4 hover:text-fit-magenta hover:cursor-pointer"></x-heroicon-o-trash>
                <x-heroicon-o-square-2-stack
                    class="h-4 w-4 hover:text-fit-magenta hover:cursor-pointer"></x-heroicon-o-square-2-stack>
            </div>
        </div>
    </div>
</div>
