<div class="select-none bg-fit-lighter-gray p-4 md:p-12">
    <div class="flex flex-col items-center space-y-6 text-center">
        <div>
            <h2>Calcolo del carico</h2>
            <p wire:click="resetAll" class="text-sm text-fit-magenta hover:underline">Reset</p>
        </div>
        <div class="w-full space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <div
                        wire:click="calculateMassimale"
                        class="bg-gray-200 grid items-center p-1.5 rounded-md hover:bg-yellow-200 hover:text-orange-500 hover:cursor-pointer">
                        <x-heroicon-o-sparkles class="w-4 h-4"></x-heroicon-o-sparkles>
                    </div>
                    <p>Massimale <span class="text-xs font-bold">(Kg)</span></p>
                </div>
                <div class="flex items-center space-x-2">
                    <div wire:click="decrement('massimale')"
                         class="flex items-center justify-center h-6 w-6 border border-fit-dark-gray rounded-full {{ $massimale <= 0 ? 'opacity-50 cursor-not-allowed' : 'hover:cursor-pointer' }}">
                        <x-heroicon-o-minus class="h-4 w-4 text-fit-dark-gray"></x-heroicon-o-minus>
                    </div>
                    {{--                    <span class="font-fit-bold">{{ $massimale }}</span>--}}
                    <input type="number" wire:model.debounce.250ms="massimale"
                           class="counter-input bg-transparent p-0 w-16 text-xl text-center font-fit-bold truncate"/>
                    <div wire:click="increment('massimale')"
                         class="flex items-center justify-center h-6 w-6 border border-fit-dark-gray rounded-full hover:cursor-pointer">
                        <x-heroicon-o-plus class="h-4 w-4 text-fit-dark-gray"></x-heroicon-o-plus>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <div
                        wire:click="calculatePercentuale"
                        class="bg-gray-200 grid items-center p-1.5 rounded-md hover:bg-yellow-200 hover:text-orange-500 hover:cursor-pointer">
                        <x-heroicon-o-sparkles class="w-4 h-4"></x-heroicon-o-sparkles>
                    </div>
                    <p>Percentuale <span class="text-xs font-bold">(%)</span></p>
                </div>
                <div class="flex items-center space-x-2">
                    <div wire:click="decrement('percentuale')"
                         class="flex items-center justify-center h-6 w-6 border border-fit-dark-gray rounded-full {{ $percentuale <= 0 ? 'opacity-50 cursor-not-allowed' : 'hover:cursor-pointer' }}">
                        <x-heroicon-o-minus class="h-4 w-4 text-fit-dark-gray"></x-heroicon-o-minus>
                    </div>
                    {{--                    <span class="font-fit-bold">{{ $percentuale }}</span>--}}
                    <input type="number" wire:model.debounce.250ms="percentuale"
                           class="counter-input bg-transparent p-0 w-16 text-xl text-center font-fit-bold truncate"/>
                    <div wire:click="increment('percentuale')"
                         class="flex items-center justify-center h-6 w-6 border border-fit-dark-gray rounded-full hover:cursor-pointer">
                        <x-heroicon-o-plus class="h-4 w-4 text-fit-dark-gray"></x-heroicon-o-plus>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <div
                        wire:click="calculateEffettivo"
                        class="bg-gray-200 grid items-center p-1.5 rounded-md hover:bg-yellow-200 hover:text-orange-500 hover:cursor-pointer">
                        <x-heroicon-o-sparkles class="w-4 h-4"></x-heroicon-o-sparkles>
                    </div>
                    <p>Effettivo <span class="text-xs font-bold">(Kg)</span></p>
                </div>
                <div class="flex items-center space-x-2">
                    <div wire:click="decrement('effettivo')"
                         class="flex items-center justify-center h-6 w-6 border border-fit-dark-gray rounded-full {{ $effettivo <= 0 ? 'opacity-50 cursor-not-allowed' : 'hover:cursor-pointer' }}">
                        <x-heroicon-o-minus class="h-4 w-4 text-fit-dark-gray"></x-heroicon-o-minus>
                    </div>
                    {{--                    <span class="font-fit-bold">{{ $effettivo }}</span>--}}
                    <input type="number" wire:model.debounce.250ms="effettivo"
                           class="counter-input bg-transparent p-0 w-16 text-xl text-center font-fit-bold truncate"/>
                    <div wire:click="increment('effettivo')"
                         class="flex items-center justify-center h-6 w-6 border border-fit-dark-gray rounded-full hover:cursor-pointer">
                        <x-heroicon-o-plus class="h-4 w-4 text-fit-dark-gray"></x-heroicon-o-plus>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center space-x-5">
            <x-primary-button color="magenta" wire:click="save">
                <x-heroicon-m-check class="w-4 h-4"></x-heroicon-m-check>
            </x-primary-button>
            <x-primary-button type="button" color="ghost" wire:click="$emit('closeModal')">
                <x-heroicon-m-x-mark class="w-4 h-4"></x-heroicon-m-x-mark>
            </x-primary-button>
        </div>
    </div>
</div>
