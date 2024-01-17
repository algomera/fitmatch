<div
    class="m-1 select-none border border-b-4 rounded-md overflow-hidden w-56 min-h-[230px] shrink-0"
    style="border-bottom-color: {{ $color }}"
>
    <div class="flex flex-col w-full h-full items-start justify-center bg-white space-y-1.5">
        <div class="flex w-full items-center flex-1 p-4 border-b">
            <h4 class="text-2xl font-bold truncate">Carico</h4>
        </div>
        <div class="flex w-full items-center justify-between flex-1 p-4">
            @if($item->freestyle)
                <h4 class="text-2xl font-bold truncate">PC</h4>
            @elseif($item->max)
                <h4 class="text-2xl font-bold truncate">MAX</h4>
            @else
                <h4 class="text-2xl font-bold truncate">{{ $item->quantity }}</h4>
            @endif
            <div class="flex items-center space-x-2">
                <div
                    wire:click="$emit('openModal', 'personal-trainer.workouts.modals.cargo-calculation', {{ json_encode(['item' => $item->id, 'serie' => $serie->id]) }})"
                    class="flex items-center justify-center h-10 w-10 bg-fit-magenta rounded-md hover:cursor-pointer">
                    <x-heroicon-o-calculator class="h-6 w-6 text-white"></x-heroicon-o-calculator>
                </div>
            </div>
        </div>
        <div class="border-t w-full flex items-center justify-between p-4">
            <div class="flex space-x-2">
                @if($item->max)
                    <x-heroicon-o-chart-bar wire:click="setMax"
                                            class="h-4 w-4 stroke-fit-magenta fill-fit-magenta cursor-pointer"
                    ></x-heroicon-o-chart-bar>
                @else
                    <x-heroicon-o-chart-bar wire:click="setMax"
                                            class="h-4 w-4 cursor-pointer"></x-heroicon-o-chart-bar>
                @endif
                @if($item->freestyle)
                    <x-heroicon-o-user wire:click="setFreestyle"
                                       class="h-4 w-4 stroke-fit-magenta fill-fit-magenta cursor-pointer"
                    ></x-heroicon-o-user>
                @else
                    <x-heroicon-o-user wire:click="setFreestyle" class="h-4 w-4 cursor-pointer"></x-heroicon-o-user>
                @endif
                {{--                <x-heroicon-o-queue-list--}}
                {{--                    class="h-4 w-4 hover:text-fit-magenta hover:cursor-pointer"></x-heroicon-o-queue-list>--}}
            </div>
            <div class="flex space-x-2">
                <x-heroicon-o-trash
                    wire:click="delete"
                    class="h-4 w-4 hover:text-fit-magenta hover:cursor-pointer"></x-heroicon-o-trash>
                <x-heroicon-o-square-2-stack
                    class="h-4 w-4 hover:text-fit-magenta hover:cursor-pointer"></x-heroicon-o-square-2-stack>
            </div>
        </div>
    </div>
</div>
