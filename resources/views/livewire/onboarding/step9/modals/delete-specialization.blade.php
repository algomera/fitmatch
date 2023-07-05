<div class="bg-fit-lighter-gray p-4 md:p-12">
    <div class="flex flex-col items-center space-y-6 text-center">
        <h1 class="text-3xl font-bold text-fit-black">Vuoi eliminare questa specializzazione?</h1>
        <div class="flex items-center space-x-10">
            <x-primary-button wire:click="$emit('closeModal')" class="!px-14">Annulla</x-primary-button>
            <x-fit-secondary-button wire:click="delete" class="!px-14">Elimina</x-fit-secondary-button>
        </div>
    </div>
</div>
