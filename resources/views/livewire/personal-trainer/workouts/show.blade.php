<div class="bg-white">
    <div class="max-w-7xl mx-auto py-6 px-4 space-y-2 sm:px-6 lg:px-8">
        @if($athlete)
        <div class="flex items-center space-x-5 border-b pb-5">
            @if($athlete->informations->profile_image)
                <img src="{{ asset($athlete->informations->profile_image) }}"
                     class="w-11 h-11 bg-gray-200 ring-2 ring-white rounded-full"/>
            @else
                <div class="w-11 h-11 bg-gray-200 ring-2 ring-white rounded-full"></div>
            @endif
            <h3>{{ $athlete->fullName }}</h3>
        </div>
        @endif
        <div class="flex items-center justify-between">
            <p class="text-sm">Dal <span class="font-semibold">{{ $workout->start_date->format('d/m/Y') }}</span> al <span class="font-semibold">{{ $workout->end_date->format('d/m/Y') }}</span></p>
            <div>
                <x-primary-button color="ghost">Copia settimana</x-primary-button>
            </div>
        </div>
    </div>
    <div class="min-w-0 max-w-none flex-auto px-4 py-6 lg:max-w-none lg:pl-6 lg:pr-0">
        <div class="flex">
            <div class="flex w-40"></div>
            <div class="flex items-center">
                <div class="flex items-center space-x-5 bg-fit-lighter-gray rounded-t-md px-4 py-2.5">
                    <span class="text-fit-dark-blue font-bold">Nome allenamento</span>
                    <span>&times;</span>
                </div>
                <div class="ml-3 flex items-center justify-center w-5 h-5 bg-fit-magenta rounded-full hover:cursor-pointer hover:bg-fit-magenta/70">
                    <x-heroicon-o-plus class="w-3 h-3 text-white"></x-heroicon-o-plus>
                </div>
            </div>
        </div>
        <div class="flex">
            <div class="flex mt-4 h-40 w-40">
                <div class="relative flex flex-col items-end px-2 w-8">
                    <span class="text-xl font-bold text-fit-magenta">01</span>
                    <span class="absolute inset-y-0 right-0 flex-1 w-[3px] bg-fit-magenta"></span>
                    <div class="absolute bottom-0 flex items-center justify-center w-6 h-6 bg-fit-magenta rounded-full hover:cursor-pointer hover:bg-fit-magenta/70">
                        <x-heroicon-o-plus class="w-3.5 h-3.5 text-white"></x-heroicon-o-plus>
                    </div>
                </div>
            </div>
            <div class="flex flex-1 bg-fit-lighter-gray space-x-4 p-4">
                <div class="flex">
                    <div class="flex items-center justify-center w-40 h-40 bg-white">
                        <x-dropdown align="left">
                            <x-slot:trigger>
                                <div class="flex items-center justify-center w-10 h-10 bg-fit-magenta hover:cursor-pointer hover:bg-fit-magenta/70 rounded-lg">
                                    <x-heroicon-o-plus class="w-6 h-6 text-white"></x-heroicon-o-plus>
                                </div>
                            </x-slot:trigger>
                            <x-slot:content>
                                <div class="px-1 space-y-1">
                                    <div class="px-1 py-1 flex items-center space-x-2 text-fit-dark-blue text-sm rounded hover:cursor-pointer hover:text-white hover:bg-fit-dark-blue">
                                        <x-heroicon-o-plus-circle class="w-4 h-4"></x-heroicon-o-plus-circle>
                                        <span>Esercizio</span>
                                    </div>
                                    <div class="px-1 py-1 flex items-center space-x-2 text-fit-dark-blue text-sm rounded hover:cursor-pointer hover:text-white hover:bg-fit-dark-blue">
                                        <x-heroicon-o-plus-circle class="w-4 h-4"></x-heroicon-o-plus-circle>
                                        <span>Ripetizioni</span>
                                    </div>
                                    <div class="px-1 py-1 flex items-center space-x-2 text-fit-dark-blue text-sm rounded hover:cursor-pointer hover:text-white hover:bg-fit-dark-blue">
                                        <x-heroicon-o-plus-circle class="w-4 h-4"></x-heroicon-o-plus-circle>
                                        <span>Recupero</span>
                                    </div>
                                    <div class="px-1 py-1 flex items-center space-x-2 text-sm text-fit-purple-blue rounded hover:cursor-pointer hover:text-white hover:bg-fit-purple-blue">
                                        <x-heroicon-o-plus-circle class="w-4 h-4"></x-heroicon-o-plus-circle>
                                        <span>Nuova serie</span>
                                    </div>
                                    <div class="px-1 py-1 flex items-center space-x-2 text-sm text-fit-purple-blue rounded hover:cursor-pointer hover:text-white hover:bg-fit-purple-blue">
                                        <x-heroicon-o-square-2-stack class="w-4 h-4"></x-heroicon-o-square-2-stack>
                                        <span>Duplica serie orizzontale</span>
                                    </div>
                                    <div class="px-1 py-1 flex items-center space-x-2 text-sm text-fit-purple-blue rounded hover:cursor-pointer hover:text-white hover:bg-fit-purple-blue">
                                        <x-heroicon-o-square-2-stack class="w-4 h-4"></x-heroicon-o-square-2-stack>
                                        <span>Duplica serie verticale</span>
                                    </div>
                                    <div class="px-1 py-1 flex items-center space-x-2 text-sm text-fit-magenta rounded hover:cursor-pointer hover:text-white hover:bg-fit-magenta">
                                        <x-heroicon-o-stop-circle class="w-4 h-4"></x-heroicon-o-stop-circle>
                                        <span>Fine esercizio</span>
                                    </div>
                                </div>
                            </x-slot:content>
                        </x-dropdown>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
