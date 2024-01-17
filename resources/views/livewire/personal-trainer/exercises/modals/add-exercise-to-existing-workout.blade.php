<div class="bg-fit-lighter-gray p-4 md:p-12">
    <div class="space-y-6">
        <h2>Assegna l'esercizio</h2>
        <div class="w-full">
            <div class="grid grid-cols-2 gap-5">
                <div class="col-span-2 space-y-5">
                    <x-select wire:model="selectedWorkout" name="selectedWorkout" id="selectedWorkout"
                              label="Seleziona una scheda"
                              required>
                        <x-slot:action>
                            <span
                                wire:click="$emit('openModal', 'personal-trainer.workouts.modals.create-workout', {{ json_encode(['from_exercises_modal' => true]) }})"
                                class="text-xs cursor-pointer hover:text-fit-magenta">Crea</span>
                        </x-slot:action>
                        <option value="">Seleziona</option>
                        @foreach($workouts as $workout)
                            <option value="{{ $workout->id }}">
                                {{ $workout->name }} ({{ $workout->athlete->full_name ?? 'Non assegnata' }})
                            </option>
                        @endforeach
                    </x-select>
                    @if($selectedWorkout)
                        <x-select wire:model="selectedWeek" name="selectedWeek" id="selectedWeek"
                                  label="Seleziona una settimana"
                                  required>
                            <option value="">Seleziona</option>
                            @foreach($weeks as $week)
                                <option value="{{ $week->id }}">
                                    {{ $week->week }}
                                </option>
                            @endforeach
                        </x-select>
                    @endif
                    @if($selectedWeek)
                        <x-select wire:model="selectedDay" name="selectedDay" id="selectedDay"
                                  label="Seleziona un giorno"
                                  required>
                            <x-slot:action>
                                <x-dropdown>
                                    <x-slot:trigger>
                                        <span class="text-xs cursor-pointer hover:text-fit-magenta">Aggiungi</span>
                                    </x-slot:trigger>
                                    <x-slot:content>
                                        @foreach(config('fitmatch.days') as $k => $d)
                                            @if(!in_array($k, $days->pluck('day')->toArray()))
                                                <span
                                                    wire:click="addDayToWeek({{ $k }})"
                                                    class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:cursor-pointer hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                                {{ $d }}
                                            </span>
                                            @else
                                                <span
                                                    class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700/20 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                                {{ $d }}
                                            </span>
                                            @endif
                                        @endforeach
                                    </x-slot:content>
                                </x-dropdown>
                            </x-slot:action>
                            <option value="">Seleziona</option>
                            @foreach($days as $day)
                                <option value="{{ $day->id }}">
                                    {{ config('fitmatch.days.' . $day->day) }}
                                </option>
                            @endforeach
                        </x-select>
                    @endif
                    @if($selectedDay)
                        <x-select wire:model="selectedSet" name="selectedSet" id="selectedSet"
                                  label="Seleziona un Set"
                                  required>
                            <x-slot:action>
                                <span wire:click="addSetToDay" class="text-xs cursor-pointer hover:text-fit-magenta">Aggiungi</span>
                            </x-slot:action>
                            <option value="">Seleziona</option>
                            @foreach($sets as $set)
                                <option value="{{ $set->id }}">
                                    {{ str_pad($loop->iteration, 2, "0", STR_PAD_LEFT) }}
                                </option>
                            @endforeach
                        </x-select>
                    @endif
                    @if($selectedSet)
                        <x-select wire:model="selectedSerie" name="selectedSerie" id="selectedSerie"
                                  label="Seleziona una Serie"
                                  required>
                            <x-slot:action>
                                <span wire:click="addSerieToSet" class="text-xs cursor-pointer hover:text-fit-magenta">Aggiungi</span>
                            </x-slot:action>
                            <option value="">Seleziona</option>
                            @foreach($series as $serie)
                                <option value="{{ $serie->id }}">
                                    {{ str_pad($loop->iteration, 2, "0", STR_PAD_LEFT) }}
                                </option>
                            @endforeach
                        </x-select>
                    @endif
                </div>
            </div>
        </div>
        <div class="flex justify-end space-x-5">
            <x-primary-button color="blue" wire:click="add">Assegna</x-primary-button>
        </div>
    </div>
</div>
