<div class="flex justify-center lg:px-8 max-w-8xl mx-auto relative sm:px-2 xl:px-12">
    <div class="hidden lg:relative lg:block lg:flex-none">
        <div class="absolute inset-y-0 right-0 w-[50vw] bg-white"></div>
        <div
            class="sticky h-[calc(100vh-4.5rem)] pl-0.5 overflow-y-auto overflow-x-hidden py-6 xl:w-72 xl:pr-6">
            <h3>Lista atleti</h3>
            <div class="flex flex-1 items-center justify-center mt-3">
                <div class="w-full max-w-lg lg:max-w-xs">
                    <label for="search" class="sr-only">Cerca..</label>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                 aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <input wire:model.debounce.250ms="search" id="search" name="search"
                               class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                               placeholder="Cerca.." type="search">
                    </div>
                </div>
            </div>
            <nav class="text-base lg:text-sm py-4">
                <ul class="space-y-5">
                    @forelse($athletes as $athlete)
                        <li wire:click="setAthlete({{$athlete->id}})"
                            class="{{ $athlete->is($selectedAthlete) ? '' : 'group cursor-pointer' }} flex items-center space-x-5">
                            @if($athlete->avatar() !== '')
                                <img src="{{ $athlete->avatar() }}"
                                     class="w-9 h-9 bg-gray-200 ring-2 ring-white rounded-full"/>
                            @else
                                <div class="w-9 h-9 bg-gray-200 ring-2 ring-white rounded-full"></div>
                            @endif
                            <p class="{{ $athlete->is($selectedAthlete) ? 'text-fit-magenta' : 'text-fit-dark-gray group-hover:text-fit-magenta hover:cursor-pointer' }} font-semibold">{{ $athlete->full_name }}</p>
                        </li>
                    @empty
                        Nessun atleta presente
                    @endforelse
                </ul>
            </nav>
        </div>
    </div>
    @if($selectedAthlete)
        <div class="min-w-0 max-w-none flex-auto px-4 py-6 lg:max-w-none lg:pl-6 lg:pr-0">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="col-span-2 space-y-5">
                    <div class="flex items-center space-x-5">
                        @if($selectedAthlete->avatar())
                            <img src="{{ $selectedAthlete->avatar() }}"
                                 class="w-11 h-11 bg-gray-200 ring-2 ring-white rounded-full"/>
                        @else
                            <div class="w-11 h-11 bg-gray-200 ring-2 ring-white rounded-full"></div>
                        @endif
                        <h3>{{ $athlete->full_name }}</h3>
                    </div>
                    <div class="grid grid-cols-2 gap-5 sm:grid-cols-3">
                        <div class="bg-white col-span-1">
                            <div class="p-2 border-b">
                                <p class="text-lg font-fit-bold text-fit-dark-gray">Anni</p>
                            </div>
                            <div class="p-2">
                                <p class="text-lg font-semibold">32</p>
                            </div>
                        </div>
                        <div class="bg-white col-span-1">
                            <div class="p-2 border-b">
                                <p class="text-lg font-fit-bold text-fit-dark-gray">Ultima sessione</p>
                            </div>
                            <div class="p-2">
                                <p class="text-lg font-semibold">2 giorni fa</p>
                            </div>
                        </div>
                        <div class="bg-white col-span-1">
                            <div class="p-2 border-b">
                                <p class="text-lg font-fit-bold text-fit-dark-gray">Sessioni rimaste</p>
                            </div>
                            <div class="p-2">
                                <p class="text-lg font-semibold">8/12</p>
                            </div>
                        </div>
                        <div class="bg-white col-span-1">
                            <div class="p-2 border-b">
                                <p class="text-lg font-fit-bold text-fit-dark-gray">Sesso</p>
                            </div>
                            <div class="p-2">
                                <p class="text-lg font-semibold">{{ $athlete->informations->gender === 'male' ? 'Maschio' : 'Femmina' }}</p>
                            </div>
                        </div>
                        <div class="bg-white col-span-1">
                            <div class="p-2 border-b">
                                <p class="text-lg font-fit-bold text-fit-dark-gray">Livello</p>
                            </div>
                            <div class="p-2">
                                <p class="text-lg font-semibold">Avanzato</p>
                            </div>
                        </div>
                        <div class="bg-white col-span-1">
                            <div class="p-2 border-b">
                                <p class="text-lg font-fit-bold text-fit-dark-gray">Data di inizio</p>
                            </div>
                            <div class="p-2">
                                <p class="text-lg font-semibold">gg/mm/aaaa</p>
                            </div>
                        </div>
                        <div class="bg-white col-span-1">
                            <div class="p-2 border-b">
                                <p class="text-lg font-fit-bold text-fit-dark-gray">Peso</p>
                            </div>
                            <div class="p-2">
                                <p class="text-lg font-semibold">82Kg</p>
                            </div>
                        </div>
                        <div class="bg-white col-span-2">
                            <div class="p-2 border-b">
                                <p class="text-lg font-fit-bold text-fit-dark-gray">Obbiettivo</p>
                            </div>
                            <div class="p-2">
                                <p class="text-lg font-semibold">Ricomposizione corporea</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-5">
                        @if($selectedAthlete->anamnesi)
                            @if(!auth()->user()->haveAccessToAnamnesiOf($selectedAthlete->anamnesi->id))
                                <x-primary-button wire:click="requestAnamnesiAccess">
                                    Richiedi Anamnesi
                                </x-primary-button>
                            @elseif(!auth()->user()->anamnesiAccepted($selectedAthlete->anamnesi->id))
                                <x-primary-button wire:click="cancelAnamnesiAccess">
                                    Annulla richiesta Anamnesi
                                </x-primary-button>
                            @else
                                <x-primary-button
                                    wire:click="$emit('openModal', 'personal-trainer.athletes.anamnesi.show', {{ json_encode(['anamnesi' => $selectedAthlete->anamnesi->id]) }})">
                                    Anamnesi
                                </x-primary-button>
                            @endif
                        @endif
                        <x-primary-button
                            href="{{ route('personal-trainer.athlete.performance', $athlete->id) }}"
                            color="ghost"
                        >
                            Storico prestazioni
                        </x-primary-button>
                    </div>
                </div>
                <div>
                    <div class="border-b pb-5">
                        <h4 class="font-fit-bold text-fit-purple-blue">Schede</h4>
                    </div>
                    <div class="pt-5 -mt-px space-y-5">
                        @foreach($selectedAthlete->athlete_workouts as $workout)
                            <livewire:components.workout :workout="$workout"/>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @else
        <div
            class="flex items-center justify-center min-w-0 max-w-none flex-auto px-4 py-6 lg:max-w-none lg:pl-6 lg:pr-0">
            <div class="text-center">
                <x-heroicon-o-users class="mx-auto h-12 w-12 text-gray-400"></x-heroicon-o-users>
                <h3 class="mt-2 text-sm font-semibold text-gray-900">Seleziona un atleta</h3>
                <p class="mt-1 text-sm text-gray-500">Seleziona un atleta per visualizzarne le informazioni</p>
            </div>
        </div>
    @endif
</div>
