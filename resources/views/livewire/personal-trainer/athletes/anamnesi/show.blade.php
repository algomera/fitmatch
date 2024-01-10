<div>
    <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
        <aside class="p-6 lg:col-span-3">
            <div class="flex items-center space-x-5">
                @if($athlete->avatar())
                    <img src="{{ $athlete->avatar() }}"
                         class="w-11 h-11 bg-gray-200 ring-2 ring-white rounded-full"/>
                @else
                    <div class="w-11 h-11 bg-gray-200 ring-2 ring-white rounded-full"></div>
                @endif
                <h3>{{ $athlete->full_name }}</h3>
            </div>
            <nav class="space-y-1.5 mt-5">
                <!-- Current: "text-fit-magenta", Default: "text-fit-dark-gray" -->
                <!-- First level: "text-lg", Second level: "text-sm" -->
                @foreach($tabs as $k => $tab)
                    <div
                        @if(!isset($tab['children']))
                            wire:click.stop="$set('selectedTab', '{{ $k }}')"
                        @endif
                        class="{{ $selectedTab === $k ? 'text-fit-magenta' : 'text-fit-dark-gray' }} {{ !isset($tab['children']) ? 'hover:text-fit-magenta cursor-pointer' : '' }} group flex flex-col items-start rounded-md px-3 py-2 text-lg font-medium">
                        <span class="truncate">{{ $tab['label'] }}</span>
                        @isset($tab['children'])
                            <ul class="ml-3 space-y-1 text-sm">
                                @foreach($tab['children'] as $child => $label)
                                    @if($child === 'mestrual_cycle')
                                        @if($athlete->informations->gender === 'female' || $athlete->informations->gender === 'other')
                                            <li wire:click.stop="$set('selectedTab', '{{ $child }}')"
                                                class="{{ $selectedTab === $child ? 'text-fit-magenta' : 'text-fit-dark-gray' }} hover:cursor-pointer hover:text-fit-magenta">{{ $label }}</li>
                                        @endif
                                    @else
                                        <li wire:click.stop="$set('selectedTab', '{{ $child }}')"
                                            class="{{ $selectedTab === $child ? 'text-fit-magenta' : 'text-fit-dark-gray' }} hover:cursor-pointer hover:text-fit-magenta">{{ $label }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        @endisset
                    </div>
                @endforeach
            </nav>
        </aside>

        <div class="p-6 bg-gray-50 space-y-6 lg:col-span-9">
            @switch($selectedTab)
                @case('personal_data')
                    <livewire:personal-trainer.athletes.anamnesi.tabs.personal-data :athlete="$athlete"/>
                    @break
                @case('work')
                    <livewire:personal-trainer.athletes.anamnesi.tabs.work :athlete="$athlete"/>
                    @break
                @case('smoke_and_alcool')
                    <livewire:personal-trainer.athletes.anamnesi.tabs.physiology.smoke-and-alcool :athlete="$athlete"/>
                    @break
                @case('bladder_and_intestine')
                    <livewire:personal-trainer.athletes.anamnesi.tabs.physiology.bladder-and-intestine
                        :athlete="$athlete"/>
                    @break
                @case('drugs')
                    <livewire:personal-trainer.athletes.anamnesi.tabs.physiology.drugs
                        :athlete="$athlete"/>
                    @break
                @case('diet')
                    <livewire:personal-trainer.athletes.anamnesi.tabs.physiology.diet
                        :athlete="$athlete"/>
                    @break
                @case('sleep')
                    <livewire:personal-trainer.athletes.anamnesi.tabs.physiology.sleep
                        :athlete="$athlete"/>
                    @break
                @case('pathologies')
                    <livewire:personal-trainer.athletes.anamnesi.tabs.physiology.pathologies
                        :athlete="$athlete"/>
                    @break
                @case('mestrual_cycle')
                    @if($athlete->informations->gender === 'female' || $athlete->informations->gender === 'other')
                        <livewire:personal-trainer.athletes.anamnesi.tabs.physiology.mestrual-cycle
                            :athlete="$athlete"/>
                    @endif
                    @break
                @case('anthropometric_measurements')
                    <livewire:personal-trainer.athletes.anamnesi.tabs.anthropometric-measurements
                        :athlete="$athlete"/>
                    @break
                @case('sports')
                    <livewire:personal-trainer.athletes.anamnesi.tabs.general-informations.sports
                        :athlete="$athlete"/>
                    @break
                @case('training_techniques')
                    <livewire:personal-trainer.athletes.anamnesi.tabs.general-informations.training-techniques
                        :athlete="$athlete"/>
                    @break
                @case('meals')
                    <livewire:personal-trainer.athletes.anamnesi.tabs.general-informations.meals
                        :athlete="$athlete"/>
                    @break
                @case('nutritional')
                    <livewire:personal-trainer.athletes.anamnesi.tabs.nutritional :athlete="$athlete"/>
                    @break
            @endswitch
        </div>
    </div>
</div>
