<div class="select-none bg-fit-lighter-gray p-4 md:p-12">
    <div class="flex flex-col items-center space-y-6 text-center">
        <h2>Calcolo del carico</h2>
        <div class="w-full space-y-6">
            <div class="flex items-center justify-between">
                <span>Massimale</span>
                <div class="flex items-center space-x-2">
                    <div wire:click="decrement('massimale')"
                         class="flex items-center justify-center h-6 w-6 border border-fit-dark-gray rounded-full {{ $massimale <= 0 ? 'opacity-50 cursor-not-allowed' : 'hover:cursor-pointer' }}">
                        <x-heroicon-o-minus class="h-4 w-4 text-fit-dark-gray"></x-heroicon-o-minus>
                    </div>
                    <span class="font-bold">{{ $massimale }}</span>
                    <div wire:click="increment('massimale')"
                         class="flex items-center justify-center h-6 w-6 border border-fit-dark-gray rounded-full hover:cursor-pointer">
                        <x-heroicon-o-plus class="h-4 w-4 text-fit-dark-gray"></x-heroicon-o-plus>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <span>Percentuale</span>
                <div class="flex items-center space-x-2">
                    <div wire:click="decrement('percentuale')"
                         class="flex items-center justify-center h-6 w-6 border border-fit-dark-gray rounded-full {{ $percentuale <= 0 ? 'opacity-50 cursor-not-allowed' : 'hover:cursor-pointer' }}">
                        <x-heroicon-o-minus class="h-4 w-4 text-fit-dark-gray"></x-heroicon-o-minus>
                    </div>
                    <span class="font-bold">{{ $percentuale }}</span>
                    <div wire:click="increment('percentuale')"
                         class="flex items-center justify-center h-6 w-6 border border-fit-dark-gray rounded-full hover:cursor-pointer">
                        <x-heroicon-o-plus class="h-4 w-4 text-fit-dark-gray"></x-heroicon-o-plus>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <span>Effettivo</span>
                <div class="flex items-center space-x-2">
                    <div wire:click="decrement('effettivo')"
                         class="flex items-center justify-center h-6 w-6 border border-fit-dark-gray rounded-full {{ $effettivo <= 0 ? 'opacity-50 cursor-not-allowed' : 'hover:cursor-pointer' }}">
                        <x-heroicon-o-minus class="h-4 w-4 text-fit-dark-gray"></x-heroicon-o-minus>
                    </div>
                    <span class="font-bold">{{ $effettivo }}</span>
                    <div wire:click="increment('effettivo')"
                         class="flex items-center justify-center h-6 w-6 border border-fit-dark-gray rounded-full hover:cursor-pointer">
                        <x-heroicon-o-plus class="h-4 w-4 text-fit-dark-gray"></x-heroicon-o-plus>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center space-x-5">
            <x-primary-button type="button" color="ghost" wire:click="$emit('closeModal')">Annulla</x-primary-button>
            <x-primary-button color="magenta" wire:click="save">Conferma</x-primary-button>
        </div>
    </div>
</div>
