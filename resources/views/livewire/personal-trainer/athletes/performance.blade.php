<div>
    <div class="bg-white shadow h-40 flex items-center">
        <div class="container max-w-7xl mx-auto flex items-center space-x-6 px-4">
            <div class="w-44">
                <x-select wire:model="selectedWorkout">
                    <option value="">Scheda</option>
                    @foreach($workouts as $workout)
                        <option value="{{ $workout->id }}">{{ $workout->name }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="w-44">
                <x-select wire:model="selectedWeek" :disabled="!$selectedWorkout">
                    <option value="">Settimana</option>
                    @foreach($weeks as $week)
                        <option value="{{ $week->id }}">{{ $week->week }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="w-44">
                <x-select wire:model="selectedDay" :disabled="!$selectedWeek">
                    <option value="">Giorno</option>
                    @foreach($days as $day)
                        <option value="{{ $day->id }}">{{ config('fitmatch.days.' . $day->day) }}</option>
                    @endforeach
                </x-select>
            </div>
        </div>
    </div>
    <div class="relative min-h-screen bg-fit-lighter-gray overflow-x-scroll">
        @forelse($weeks as $week)
            @if(!$selectedWeek)
                <h3 class="sticky left-0 mt-4 px-4 text-lg font-semibold">Settimana {{ $week->week }}</h3>
                @foreach($week->workout_days as $day)
                    @if(!$selectedDay)
                        <h3 class="sticky left-0 px-4 text-sm font-semibold">{{ config('fitmatch.days.' . $day->day) }}</h3>
                        <div class="flex flex-col">
                            @foreach($day->workout_sets as $set)
                                <div wire:key="set-{{$set->id}}" class="flex">
                                    <div class="sticky left-0 z-[99] flex py-4 min-h-[10rem] px-4 bg-fit-lighter-gray">
                                        <div class="relative flex flex-col items-end px-2 w-8">
                                <span
                                    class="text-xl font-bold text-fit-magenta">{{ str_pad($loop->iteration, 2, "0", STR_PAD_LEFT) }}</span>
                                            <span
                                                class="absolute inset-y-0 right-0 flex-1 w-[3px] bg-fit-magenta"></span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col w-full z-[50]">
                                        @foreach($set->workout_series as $serie)
                                            <div wire:key="{{ $set->id }}-{{ $serie->id }}"
                                                 class="relative flex-1 py-4">
                                                <div class="flex">
                                                    @foreach($serie->items as $item)
                                                        @switch($item->item_type)
                                                            @case('App\Models\Exercise')
                                                                @php
                                                                    $exercise = \App\Models\Exercise::find($item->item_id)
                                                                @endphp
                                                                <x-performance.exercise-card :item="$exercise"/>
                                                                @break
                                                            @case('App\Models\Repetition')
                                                                @php
                                                                    $repetition = \App\Models\Repetition::find($item->item_id)
                                                                @endphp
                                                                <x-performance.repetition-card :item="$repetition"/>
                                                                @break
                                                            @case('App\Models\Recovery')
                                                                @php
                                                                    $recovery = \App\Models\Recovery::find($item->item_id)
                                                                @endphp
                                                                <x-performance.recovery-card :item="$recovery"/>
                                                                @break
                                                            @case('App\Models\Cargo')
                                                                @php
                                                                    $cargo = \App\Models\Cargo::find($item->item_id)
                                                                @endphp
                                                                <x-performance.cargo-card :item="$cargo"/>
                                                                @break
                                                        @endswitch
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endforeach
            @elseif($selectedWeek == $week->id)
                <h3 class="sticky left-0 mt-4 px-4 text-lg font-semibold">Settimana {{ $week->week }}</h3>
                @forelse($week->workout_days as $day)
                    @if(!$selectedDay)
                        <h3 class="sticky left-0 px-4 text-sm font-semibold">{{ config('fitmatch.days.' . $day->day) }}</h3>
                        <div class="flex flex-col">
                            @foreach($day->workout_sets as $set)
                                <div wire:key="set-{{$set->id}}" class="flex">
                                    <div
                                        class="sticky left-0 z-[99] flex py-4 min-h-[10rem] px-4 bg-fit-lighter-gray">
                                        <div class="relative flex flex-col items-end px-2 w-8">
                                <span
                                    class="text-xl font-bold text-fit-magenta">{{ str_pad($loop->iteration, 2, "0", STR_PAD_LEFT) }}</span>
                                            <span
                                                class="absolute inset-y-0 right-0 flex-1 w-[3px] bg-fit-magenta"></span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col w-full z-[50]">
                                        @foreach($set->workout_series as $serie)
                                            <div wire:key="{{ $set->id }}-{{ $serie->id }}"
                                                 class="relative flex-1 py-4">
                                                <div class="flex">
                                                    @foreach($serie->items as $item)
                                                        @switch($item->item_type)
                                                            @case('App\Models\Exercise')
                                                                @php
                                                                    $exercise = \App\Models\Exercise::find($item->item_id)
                                                                @endphp
                                                                <x-performance.exercise-card :item="$exercise"/>
                                                                @break
                                                            @case('App\Models\Repetition')
                                                                @php
                                                                    $repetition = \App\Models\Repetition::find($item->item_id)
                                                                @endphp
                                                                <x-performance.repetition-card
                                                                    :item="$repetition"/>
                                                                @break
                                                            @case('App\Models\Recovery')
                                                                @php
                                                                    $recovery = \App\Models\Recovery::find($item->item_id)
                                                                @endphp
                                                                <x-performance.recovery-card :item="$recovery"/>
                                                                @break
                                                            @case('App\Models\Cargo')
                                                                @php
                                                                    $cargo = \App\Models\Cargo::find($item->item_id)
                                                                @endphp
                                                                <x-performance.cargo-card :item="$cargo"/>
                                                                @break
                                                        @endswitch
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @elseif($selectedDay == $day->id)
                        <h3 class="sticky left-0 px-4 text-sm font-semibold">{{ config('fitmatch.days.' . $day->day) }}</h3>
                        <div class="flex flex-col">
                            @foreach($day->workout_sets as $set)
                                <div wire:key="set-{{$set->id}}" class="flex">
                                    <div
                                        class="sticky left-0 z-[99] flex py-4 min-h-[10rem] px-4 bg-fit-lighter-gray">
                                        <div class="relative flex flex-col items-end px-2 w-8">
                                <span
                                    class="text-xl font-bold text-fit-magenta">{{ str_pad($loop->iteration, 2, "0", STR_PAD_LEFT) }}</span>
                                            <span
                                                class="absolute inset-y-0 right-0 flex-1 w-[3px] bg-fit-magenta"></span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col w-full z-[50]">
                                        @foreach($set->workout_series as $serie)
                                            <div wire:key="{{ $set->id }}-{{ $serie->id }}"
                                                 class="relative flex-1 py-4">
                                                <div class="flex">
                                                    @foreach($serie->items as $item)
                                                        @switch($item->item_type)
                                                            @case('App\Models\Exercise')
                                                                @php
                                                                    $exercise = \App\Models\Exercise::find($item->item_id)
                                                                @endphp
                                                                <x-performance.exercise-card :item="$exercise"/>
                                                                @break
                                                            @case('App\Models\Repetition')
                                                                @php
                                                                    $repetition = \App\Models\Repetition::find($item->item_id)
                                                                @endphp
                                                                <x-performance.repetition-card
                                                                    :item="$repetition"/>
                                                                @break
                                                            @case('App\Models\Recovery')
                                                                @php
                                                                    $recovery = \App\Models\Recovery::find($item->item_id)
                                                                @endphp
                                                                <x-performance.recovery-card :item="$recovery"/>
                                                                @break
                                                            @case('App\Models\Cargo')
                                                                @php
                                                                    $cargo = \App\Models\Cargo::find($item->item_id)
                                                                @endphp
                                                                <x-performance.cargo-card :item="$cargo"/>
                                                                @break
                                                        @endswitch
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @empty
                    <p>Questa settimana è vuota</p>
                @endforelse
            @endif
        @empty
            <div class="text-center py-10">
                <x-heroicon-o-clipboard class="mx-auto h-12 w-12 text-gray-400"></x-heroicon-o-clipboard>
                <h3 class="mt-2 text-sm font-semibold text-gray-900">Nessuna scheda selezionata</h3>
                <p class="mt-1 text-sm text-gray-500">Per iniziare, seleziona una scheda.</p>
            </div>
        @endforelse
    </div>
</div>
