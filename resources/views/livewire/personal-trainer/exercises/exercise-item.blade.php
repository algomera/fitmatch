<div
    class="flex space-x-6 py-3 select-none">
    <div class="w-full max-w-sm shrink-0">
        <h4 class="text-lg font-bold leading-tight space-x-3">
            {{ $exercise->name }}
        </h4>
        <p class="text-sm line-clamp-3 leading-relaxed mt-3">{{ $exercise->description }}</p>
    </div>
    @if($exercise->link)
        <video src="{{ $exercise->link }}" controls class="w-64 aspect-video shrink-0"></video>
    @else
        <div class="bg-gray-200 w-64 aspect-video shrink-0"></div>
    @endif
    <div class="flex flex-col justify-between w-full flex-1 shrink-0">
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
        <div class="py-2">
            <x-select wire:model="intensity" name="intensity" label="Tecnica di intensità"
                      class="shadow-none bg-gray-200 text-fit-dark-gray text-sm font-semibold px-2 py-1 !rounded-md cursor-pointer">
                <option value="">Seleziona</option>
                @foreach($intensities as $int)
                    <option value="{{ $int->id }}">{{ $int->name }}</option>
                @endforeach
            </x-select>
        </div>
        <x-primary-button
            color="ghost-blue"
            wire:click="$emit('openModal', 'personal-trainer.exercises.modals.add-exercise-to-existing-workout', {{ json_encode(['exercise' => $exercise->id, 'repetitions' => $repetitions, 'intensity' => $intensity]) }})"
            :disabled="$repetitions === 0"
            class="select-none text-center justify-center space-x-3">
            <div class="flex items-center">
                <x-heroicon-o-plus-small class="w-4 h-4"></x-heroicon-o-plus-small>
                <span>Aggiungi</span>
            </div>
        </x-primary-button>
    </div>
</div>
