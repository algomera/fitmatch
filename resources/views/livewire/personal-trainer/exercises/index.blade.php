<div>
    <div class="mx-auto max-w-7xl px-2">
        <div class="grid grid-cols-4 gap-2">
            <div class="col-span-1 p-4 space-y-5">
                <div class="flex items-center justify-between">
                    <h3>Filtri</h3>
                    @if($typology || $zone || $area)
                        <span wire:click="resetFilters" class="cursor-pointer text-sm text-fit-magenta">Reset</span>
                    @endif
                </div>
                <div class="space-y-6">
                    <x-select wire:model="typology" name="typology" id="typology" label="Tipologia">
                        <option value="">Seleziona</option>
                        @foreach($typologies as $t)
                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                        @endforeach
                    </x-select>
                    <x-select wire:model="zone" name="zone" id="zone" label="Zona" :disabled="!$typology">
                        <option value="">Seleziona</option>
                        @foreach($zones as $z)
                            <option value="{{ $z->id }}">{{ $z->name }}</option>
                        @endforeach
                    </x-select>
                    <x-select wire:model="area" name="area" id="area" label="Area" :disabled="!$zone">
                        <option value="">Seleziona</option>
                        @foreach($areas as $a)
                            <option value="{{ $a->id }}">{{ $a->name }}</option>
                        @endforeach
                    </x-select>
                </div>
                <div class="flex items-center space-x-5 mt-8">
                    @if(!$favorites)
                        <x-primary-button wire:click="$set('favorites', true)" class="justify-center">
                            Vedi preferiti
                        </x-primary-button>
                    @else
                        <x-primary-button wire:click="$set('favorites', false)" class="justify-center">
                            Nascondi preferiti
                        </x-primary-button>
                    @endif
                </div>
            </div>
            <div class="col-span-3 h-[calc(100vh-6.7rem)] overflow-y-scroll divide-y pt-4 pb-14 px-5">
                @forelse($exercises as $exercise)
                    <livewire:personal-trainer.exercises.exercise-item
                        :wire:key="$exercise->id"
                        :exercise="$exercise->id"
                        :intensities="$intensities"
                    />
                @empty
                    <p class="text-gray-600 text-sm">Nessun esercizio trovato</p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 w-full bg-white py-4 px-4">
        {{ $exercises->links() }}
    </div>
</div>
