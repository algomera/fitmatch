<div class="bg-white min-h-screen">
    <div class="max-w-7xl mx-auto py-6 px-4 space-y-2 sm:px-6 lg:px-8">
        @if($athlete)
            <div class="flex items-center justify-between border-b pb-5">
                <div class="flex items-center space-x-5">
                    @if($athlete->avatar())
                        <img src="{{ $athlete->avatar() }}"
                             class="w-11 h-11 bg-gray-200 ring-2 ring-white rounded-full"/>
                    @else
                        <div class="w-11 h-11 bg-gray-200 ring-2 ring-white rounded-full"></div>
                    @endif
                    <h3>{{ $athlete->full_name }}</h3>
                </div>
                <div class="flex items-center space-x-5">
                    <x-primary-button href="{{ route('personal-trainer.exercises') }}">
                        Vedi esercizi
                    </x-primary-button>
                    <x-primary-button color="magenta"
                                      href="{{ route('personal-trainer.exercises', ['favorites' => true]) }}">
                        Vedi preferiti
                    </x-primary-button>
                    @if($athlete->anamnesi)
                        @if(!auth()->user()->haveAccessToAnamnesiOf($athlete->anamnesi->id))
                            <x-primary-button wire:click="requestAnamnesiAccess">
                                Richiedi Anamnesi
                            </x-primary-button>
                        @elseif(!auth()->user()->anamnesiAccepted($athlete->anamnesi->id))
                            <x-primary-button wire:click="cancelAnamnesiAccess">
                                Annulla richiesta Anamnesi
                            </x-primary-button>
                        @else
                            <x-primary-button
                                color="ghost-blue"
                                wire:click="$emit('openModal', 'personal-trainer.athletes.anamnesi.show', {{ json_encode(['anamnesi' => $athlete->anamnesi->id]) }})">
                                Anamnesi
                            </x-primary-button>
                        @endif
                    @endif
                    <x-primary-button
                        href="{{ route('personal-trainer.athlete.performance', $athlete->id) }}"
                        color="link">
                        Storico prestazione
                    </x-primary-button>
                </div>
            </div>
        @endif
        <div class="flex items-center justify-between">
            @if($workout->start_date)
                <p class="text-sm">Dal <span class="font-semibold">{{ $workout->start_date->format('d/m/Y') }}</span> al
                    <span class="font-semibold">{{ $workout->end_date->format('d/m/Y') }}</span></p>
            @else
                <p></p>
            @endif
            <div class="flex items-center space-x-3">
                <div
                    class="w-44">
                    <x-select wire:model="selectedWeekId" name="selectedWeek" id="selectedWeek"
                              class="shadow-none !border !border-fit-dark-gray/80 text-fit-dark-gray text-sm font-semibold px-2 py-1.5 !rounded-md cursor-pointer">
                        @foreach($workout->workout_weeks as $week)
                            <option wire:click="selectWeek({{$week->id}})"
                                    value="{{ $week->id }}" @selected($week->id == $selectedWeekId)>
                                Settimana {{ $week->week }}</option>
                        @endforeach
                    </x-select>
                </div>
                @if($weekToCopy === $selectedWeekId || !$hasDataToCopy)
                    <x-primary-button wire:click="copyWeek({{ $selectedWeekId }})" color="ghost">Copia settimana
                    </x-primary-button>
                @endif
                @if($weekToCopy !== $selectedWeekId && $hasDataToCopy)
                    <x-primary-button
                        wire:click="$emit('openModal', 'personal-trainer.workouts.modals.paste-week', {{ json_encode(['from' => $weekToCopy, 'to' => $selectedWeekId]) }})"
                        color="blue">Incolla settimana
                    </x-primary-button>
                @endif
            </div>
        </div>
    </div>
    <div class="min-w-0 max-w-none flex-auto pt-6 lg:max-w-none min-h-screen">
        <div class="flex">
            <div class="flex w-16"></div>
            <div class="flex items-center">
                @foreach($days as $day)
                    <div
                        wire:key="day-{{$day->day}}"
                        wire:click.stop="$set('selectedDay', {{ $day->id }})"
                        class="group flex items-center space-x-5 rounded-t-md px-4 py-2.5 {{ $day->id === $selectedDay ? 'bg-fit-lighter-gray' : 'cursor-pointer' }}">
                        <span
                            class="text-sm {{ $day->id === $selectedDay ? 'text-fit-dark-blue font-fit-bold' : 'text-gray-400 group-hover:text-gray-500' }}">{{ config('fitmatch.days.' . $day->day) }}</span>
                        <span wire:key="delete-{{$day->id}}" wire:click.stop="deleteDay({{$day->id}})"
                              class="cursor-pointer">&times;</span>
                    </div>
                @endforeach
                <div class="h-11 flex items-center">
                    <div
                        class="{{ $days->count() == 0 ? 'mb-0' : 'ml-3' }} flex items-center justify-center w-5 h-5 bg-fit-magenta rounded-full hover:cursor-pointer hover:bg-fit-magenta/70 z-[60]">
                        <x-dropdown align="left">
                            <x-slot:trigger>
                                <x-heroicon-o-plus class="w-3 h-3 text-white"></x-heroicon-o-plus>
                            </x-slot:trigger>
                            <x-slot:content>
                                @foreach(config('fitmatch.days') as $k => $day)
                                    <div
                                        wire:click="addDay('{{$k}}')"
                                        class="{{ in_array($k, $days->pluck('day')->toArray()) ? 'opacity-10 !pointer-events-none' : 'hover:cursor-pointer hover:text-white hover:bg-fit-dark-blue' }} px-2 py-1 flex items-center space-x-2 text-fit-dark-blue text-sm rounded">
                                        <span>{{ $day }}</span>
                                    </div>
                                @endforeach
                            </x-slot:content>
                        </x-dropdown>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative min-h-screen bg-fit-lighter-gray overflow-x-scroll">
            @if($selectedDay)
                @foreach($sets as $set)
                    <div wire:key="set-{{$set->id}}" class="flex">
                        <div class="sticky left-0 z-[99] flex py-4 min-h-[10rem] px-4 bg-fit-lighter-gray">
                            <div class="relative flex flex-col items-end px-2 w-8">
                            <span
                                class="text-xl font-fit-bold"
                                style="color: {{config('fitmatch.workout.colors.'. $loop->index % count(config('fitmatch.workout.colors')))}}">{{ str_pad($loop->iteration, 2, "0", STR_PAD_LEFT) }}</span>
                                <span class="absolute inset-y-0 right-0 flex-1 w-[3px]"
                                      style="background-color: {{config('fitmatch.workout.colors.'. $loop->index % count(config('fitmatch.workout.colors')))}}"></span>
                                @if(!$loop->first)
                                    <div
                                        wire:click="deleteSet({{$set->id}})"
                                        class="absolute {{ $loop->last ? 'bottom-10' : 'bottom-0' }} flex items-center justify-center w-6 h-6 rounded-full hover:cursor-pointer"
                                        style="background-color: {{config('fitmatch.workout.colors.'. $loop->index % count(config('fitmatch.workout.colors')))}}"
                                    >
                                        <x-heroicon-o-minus class="w-3.5 h-3.5 text-white"></x-heroicon-o-minus>
                                    </div>
                                @endif
                                @if($loop->last)
                                    <div
                                        wire:click="addSet({{$selectedDay}})"
                                        class="z-10 absolute bottom-0 flex items-center justify-center w-6 h-6 rounded-full hover:cursor-pointer"
                                        style="background-color: {{config('fitmatch.workout.colors.'. $loop->index % count(config('fitmatch.workout.colors')))}}"
                                    >
                                        <x-heroicon-o-plus class="w-3.5 h-3.5 text-white"></x-heroicon-o-plus>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col w-full z-[50]">
                            @forelse($set->workout_series as $serie)
                                <div wire:key="{{ $set->id }}-{{ $serie->id }}"
                                     class="relative flex-1 py-4 {{ $selectedSerie == $serie->id ? 'z-50' : 'z-0' }}">
                                    {{--                                    @if($loop->index !== 0)--}}
                                    {{--                                        <div class="absolute top-1/2 -left-3 -mt-3 z-[60]">--}}
                                    {{--                                            <div--}}
                                    {{--                                                wire:click="deleteSerie({{$serie->id}})"--}}
                                    {{--                                                class="flex items-center justify-center w-6 h-6 bg-fit-magenta hover:cursor-pointer hover:bg-fit-magenta/80 rounded-md">--}}
                                    {{--                                                <x-heroicon-o-minus class="w-4 h-4 text-white"></x-heroicon-o-minus>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    @endif--}}
                                    <div class="flex">
                                        @foreach($serie->items as $item)
                                            @switch($item->item_type)
                                                @case('App\Models\Exercise')
                                                    @php
                                                        $exercise = \App\Models\Exercise::find($item->item_id)
                                                    @endphp
                                                    <livewire:exercise-card :serie="$serie" :item="$exercise"
                                                                            :row="$item->id"
                                                                            color="{{config('fitmatch.workout.colors.'. $loop->parent->parent->index % count(config('fitmatch.workout.colors')))}}"
                                                                            wire:key="{{ $selectedWeekId }}-{{ $serie->id }}-{{ $item->id }}"/>
                                                    @break
                                                @case('App\Models\Repetition')
                                                    @php
                                                        $repetition = \App\Models\Repetition::find($item->item_id)
                                                    @endphp
                                                    @if($repetition)
                                                        <livewire:repetition-card :serie="$serie" :item="$repetition"
                                                                                  :row="$item->id"
                                                                                  color="{{config('fitmatch.workout.colors.'. $loop->parent->parent->index % count(config('fitmatch.workout.colors')))}}"
                                                                                  wire:key="{{ $selectedWeekId }}-{{ $serie->id }}-{{ $item->id }}"/>
                                                    @endif
                                                    @break
                                                @case('App\Models\Recovery')
                                                    @php
                                                        $recovery = \App\Models\Recovery::find($item->item_id)
                                                    @endphp
                                                    @if($recovery)
                                                        <livewire:recovery-card :serie="$serie" :item="$recovery"
                                                                                :row="$item->id"
                                                                                color="{{config('fitmatch.workout.colors.'. $loop->parent->parent->index % count(config('fitmatch.workout.colors')))}}"
                                                                                wire:key="{{ $selectedWeekId }}-{{ $serie->id }}-{{ $item->id }}"/>
                                                    @endif
                                                    @break
                                                @case('App\Models\Cargo')
                                                    @php
                                                        $cargo = \App\Models\Cargo::find($item->item_id)
                                                    @endphp
                                                    <livewire:cargo-card :serie="$serie" :item="$cargo"
                                                                         :row="$item->id"
                                                                         color="{{config('fitmatch.workout.colors.'. $loop->parent->parent->index % count(config('fitmatch.workout.colors')))}}"
                                                                         wire:key="{{ $selectedWeekId }}-{{ $serie->id }}-{{ $item->id }}"/>
                                                    @break
                                            @endswitch
                                        @endforeach
                                        <div class="sticky left-16"
                                             wire:key="{{ $serie->id }}@isset($item)'-' . {{ $item->id }} @endisset">
                                            <div
                                                class="m-1 mr-2 flex items-center justify-center w-56 min-h-[230px] bg-white border rounded-md shrink-0">
                                                <x-dropdown
                                                    align="{{ $serie->items->count() > 0 ? 'center-left' : 'center-right' }}">
                                                    <x-slot:trigger>
                                                        <div
                                                            wire:click="$set('selectedSerie', '{{ $serie->id }}')"
                                                            class="flex items-center justify-center w-10 h-10 bg-fit-magenta hover:cursor-pointer hover:bg-fit-magenta/70 rounded-lg">
                                                            <x-heroicon-o-plus
                                                                class="w-6 h-6 text-white"></x-heroicon-o-plus>
                                                        </div>
                                                    </x-slot:trigger>
                                                    <x-slot:content>
                                                        <div class="px-1 space-y-0.5">
                                                            <div
                                                                wire:click="$emit('openModal', 'personal-trainer.workouts.modals.add-exercises', {{ json_encode(['workout' => $workout->id, 'week' => $selectedWeekId, 'day' => $selectedDay, 'set' => $set->id, 'serie' => $serie->id]) }})"
                                                                class="px-1 py-1 flex items-center space-x-2 text-fit-dark-blue text-sm rounded hover:cursor-pointer hover:text-white hover:bg-fit-dark-blue">
                                                                <x-heroicon-o-plus-circle
                                                                    class="w-4 h-4"></x-heroicon-o-plus-circle>
                                                                <span>Esercizio</span>
                                                            </div>
                                                            <div
                                                                wire:click="addRepetition({{ $serie->id }})"
                                                                class="px-1 py-1 flex items-center space-x-2 text-fit-dark-blue text-sm rounded hover:cursor-pointer hover:text-white hover:bg-fit-dark-blue">
                                                                <x-heroicon-o-plus-circle
                                                                    class="w-4 h-4"></x-heroicon-o-plus-circle>
                                                                <span>Ripetizioni</span>
                                                            </div>
                                                            <div
                                                                wire:click="addRecovery({{ $serie->id }})"
                                                                class="px-1 py-1 flex items-center space-x-2 text-fit-dark-blue text-sm rounded hover:cursor-pointer hover:text-white hover:bg-fit-dark-blue">
                                                                <x-heroicon-o-plus-circle
                                                                    class="w-4 h-4"></x-heroicon-o-plus-circle>
                                                                <span>Recupero</span>
                                                            </div>
                                                            <div
                                                                wire:click="addCargo({{ $serie->id }})"
                                                                class="px-1 py-1 flex items-center space-x-2 text-fit-dark-blue text-sm rounded hover:cursor-pointer hover:text-white hover:bg-fit-dark-blue">
                                                                <x-heroicon-o-plus-circle
                                                                    class="w-4 h-4"></x-heroicon-o-plus-circle>
                                                                <span>Carico</span>
                                                            </div>
                                                            <div
                                                                wire:click="addSerie({{ $set->id }})"
                                                                class="px-1 py-1 flex items-center space-x-2 text-sm text-fit-purple-blue rounded hover:cursor-pointer hover:text-white hover:bg-fit-purple-blue">
                                                                <x-heroicon-o-plus-circle
                                                                    class="w-4 h-4"></x-heroicon-o-plus-circle>
                                                                <span>Nuova serie</span>
                                                            </div>
                                                            <div
                                                                wire:click="duplicateSerieHorizontal({{ $serie->id }})"
                                                                class="px-1 py-1 flex items-center space-x-2 text-sm text-fit-purple-blue rounded hover:cursor-pointer hover:text-white hover:bg-fit-purple-blue">
                                                                <x-heroicon-o-square-2-stack
                                                                    class="w-4 h-4"></x-heroicon-o-square-2-stack>
                                                                <span>Duplica serie orizzontale</span>
                                                            </div>
                                                            <div
                                                                wire:click="duplicateSerieVertical({{ $serie->id }})"
                                                                class="px-1 py-1 flex items-center space-x-2 text-sm text-fit-purple-blue rounded hover:cursor-pointer hover:text-white hover:bg-fit-purple-blue">
                                                                <x-heroicon-o-square-2-stack
                                                                    class="w-4 h-4"></x-heroicon-o-square-2-stack>
                                                                <span>Duplica serie verticale</span>
                                                            </div>
                                                            @if($loop->index !== 0)
                                                                <div
                                                                    wire:click="deleteSerie({{$serie->id}})"
                                                                    class="px-1 py-1 flex items-center space-x-2 text-sm text-fit-magenta rounded hover:cursor-pointer hover:text-white hover:bg-fit-magenta">
                                                                    <x-heroicon-o-x-mark
                                                                        class="w-4 h-4"></x-heroicon-o-x-mark>
                                                                    <span>Elimina serie</span>
                                                                </div>
                                                            @endif
                                                            {{--                                                            <div--}}
                                                            {{--                                                                class="px-1 py-1 flex items-center space-x-2 text-sm text-fit-magenta rounded hover:cursor-pointer hover:text-white hover:bg-fit-magenta">--}}
                                                            {{--                                                                <x-heroicon-o-stop-circle--}}
                                                            {{--                                                                    class="w-4 h-4"></x-heroicon-o-stop-circle>--}}
                                                            {{--                                                                <span>Fine esercizio</span>--}}
                                                            {{--                                                            </div>--}}
                                                        </div>
                                                    </x-slot:content>
                                                </x-dropdown>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                no
                            @endforelse
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
