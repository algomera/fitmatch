<div class="flex justify-center lg:px-8 max-w-8xl mx-auto relative sm:px-2 xl:px-12">
    <div class="hidden lg:relative lg:block lg:flex-none">
        <div class="absolute inset-y-0 right-0 w-[50vw] bg-white"></div>
        <div
            class="sticky h-[calc(100vh-4.5rem)] pl-0.5 overflow-y-auto overflow-x-hidden py-6 w-56 xl:pr-6">
            <h3>Filtra</h3>
            <nav class="text-base lg:text-sm py-4">
                <ul class="space-y-5">
                    <li wire:click="$set('filter', 'unassigned')"
                        class="{{ $filter === 'unassigned' ? '' : 'group cursor-pointer' }} flex items-center space-x-5">
                        <div class="w-9 h-9 flex items-center justify-center">
                            <x-heroicon-o-funnel
                                class="{{ $filter === 'unassigned' ? 'text-fit-magenta' : 'text-gray-400 group-hover:text-fit-magenta' }} h-6 w-6"></x-heroicon-o-funnel>
                        </div>
                        <p class="{{ $filter === 'unassigned' ? 'text-fit-magenta' : 'text-fit-dark-gray group-hover:text-fit-magenta hover:cursor-pointer' }} font-semibold">
                            Non assegnate</p>
                    </li>
                    @foreach($athletes as $athlete)
                        <li wire:click="$set('filter', '{{$athlete->id}}')"
                            class="{{ $filter == $athlete->id ? '' : 'group cursor-pointer' }} flex items-center space-x-5">
                            @if($athlete->informations->profile_image)
                                <img src="{{ asset($athlete->informations->profile_image) }}"
                                     class="w-9 h-9 bg-gray-200 ring-2 ring-white rounded-full"/>
                            @else
                                <div class="w-9 h-9 bg-gray-200 ring-2 ring-white rounded-full"></div>
                            @endif
                            <p class="{{ $filter == $athlete->id ? 'text-fit-magenta' : 'text-fit-dark-gray group-hover:text-fit-magenta hover:cursor-pointer' }} font-semibold">{{ $athlete->full_name }}</p>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
    @if($filter)
        <div class="min-w-0 max-w-none flex-auto px-4 py-6 space-y-5 lg:pl-6 lg:pr-0">
            @if($filter !== 'unassigned')
                <div wire:key="unassigned" class="flex items-center space-x-5 border-b pb-5">
                    @if($athlete->informations->profile_image)
                        <img src="{{ asset($athlete->informations->profile_image) }}"
                             class="w-11 h-11 bg-gray-200 ring-2 ring-white rounded-full"/>
                    @else
                        <div class="w-11 h-11 bg-gray-200 ring-2 ring-white rounded-full"></div>
                    @endif
                    <h3>{{ $athlete->full_name }}</h3>
                </div>
            @endif
            @if($workouts->count())
                <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    @foreach($workouts as $workout)
                        <livewire:components.workout :workout="$workout" :key="$workout->id"/>
                    @endforeach
                </div>
            @else
                <div
                    class="flex h-full items-center justify-center min-w-0 max-w-none flex-auto px-4 py-6 lg:max-w-none lg:pl-6 lg:pr-0">
                    <div class="text-center">
                        <x-heroicon-o-rectangle-stack
                            class="mx-auto h-12 w-12 text-gray-400"></x-heroicon-o-rectangle-stack>
                        <h3 class="mt-2 text-sm font-semibold text-gray-900">Nessuna scheda</h3>
                        <p class="mt-1 text-sm text-gray-500">Nessuna scheda presente</p>
                    </div>
                </div>
            @endif
        </div>
    @else
        <div
            class="flex items-center justify-center min-w-0 max-w-none flex-auto px-4 py-6 lg:max-w-none lg:pl-6 lg:pr-0">
            <div class="text-center">
                <x-heroicon-o-funnel class="mx-auto h-12 w-12 text-gray-400"></x-heroicon-o-funnel>
                <h3 class="mt-2 text-sm font-semibold text-gray-900">Seleziona un filtro</h3>
                <p class="mt-1 text-sm text-gray-500">Seleziona un filtro per visualizzarne le schede</p>
            </div>
        </div>
    @endif
</div>
