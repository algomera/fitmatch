<div class="bg-fit-lighter-gray p-4 md:p-12">
    <div class="flex flex-col items-center space-y-6 text-center">
        <h2>Vuoi incollare tutti gli esercizi della Settimana {{ $from->week }} sulla Settimana {{ $to->week }}?</h2>
        <div class="flex items-center space-x-5">
            <x-primary-button type="button" color="ghost" wire:click="$emit('closeModal')">Annulla</x-primary-button>
            <x-primary-button color="blue" wire:click="paste">Incolla tutto</x-primary-button>
        </div>
    </div>
</div>
