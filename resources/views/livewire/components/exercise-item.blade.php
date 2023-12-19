<div
    x-data="{ added: @entangle('added') }"
    class="flex space-x-6 py-3 select-none">
    <div class="w-full max-w-md shrink-0">
        <h4 class="{{ $added ? '!text-fit-magenta' : '' }} text-lg font-bold leading-tight space-x-3">
            {{ $exercise->name }}
        </h4>
        <p class="text-sm line-clamp-3 leading-relaxed mt-3">{{ $exercise->description }}</p>
    </div>
    @if($exercise->link)
        <video src="{{ $exercise->link }}" controls class="w-64 aspect-video shrink-0"></video>
    @else
        <div class="bg-gray-200 w-64 aspect-video shrink-0"></div>
    @endif
    <div class="flex flex-col justify-between w-64 shrink-0">
        <div class="flex items-start justify-between">
            <div class="flex flex-col">
                <span class="text-sm font-semibold">Ripetizioni</span>
                <div class="flex w-full items-center justify-between flex-1 mt-1">
                    <div class="flex items-center space-x-2">
                        <div wire:click="decrement"
                             class="flex items-center justify-center h-6 w-6 border border-fit-dark-gray rounded-full {{ $repetitions <= 0 ? 'opacity-50 cursor-not-allowed' : 'hover:cursor-pointer' }}">
                            <x-heroicon-o-minus class="h-4 w-4 text-fit-dark-gray"></x-heroicon-o-minus>
                        </div>
                        {{--                        <h4 class="select-none text-2xl font-bold truncate">{{ $repetitions }}</h4>--}}
                        <input type="number" wire:model.debounce.250ms="repetitions"
                               class="counter-input bg-transparent p-0 w-10 text-2xl text-center font-bold truncate"/>
                        <div wire:click="increment"
                             class="flex items-center justify-center h-6 w-6 border border-fit-dark-gray rounded-full hover:cursor-pointer">
                            <x-heroicon-o-plus class="h-4 w-4 text-fit-dark-gray"></x-heroicon-o-plus>
                        </div>
                    </div>
                </div>
            </div>
            @if(auth()->user()->favorites->fresh()->contains($exercise->id))
                <x-heroicon-o-heart
                    wire:click="removeFavorite"
                    class="w-6 h-6 cursor-pointer stroke-fit-magenta fill-fit-magenta"></x-heroicon-o-heart>
            @else
                <x-heroicon-o-heart
                    wire:click="addFavorite"
                    class="w-6 h-6 cursor-pointer text-gray-400 hover:text-fit-magenta"></x-heroicon-o-heart>
            @endif
        </div>
        <x-primary-button color="ghost-blue"
                          x-on:click="setTimeout(() => { added = false, $wire.repetitions = 0 }, 2000);"
                          wire:click="$emit('add-exercise', {{ $exercise->id }}, {{ $repetitions }})"
                          :disabled="$repetitions === 0"
                          class="{{ $added ? '!bg-fit-magenta' : '' }} select-none text-center justify-center space-x-3">
            <div x-show="!added" class="flex items-center">
                <x-heroicon-o-plus-small class="w-4 h-4"></x-heroicon-o-plus-small>
                <span>Aggiungi</span>
            </div>
            <div x-show="added">
                <span class="!text-white">Aggiunto</span>
            </div>
        </x-primary-button>
    </div>
</div>
