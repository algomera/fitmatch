<div class="bg-fit-lighter-gray p-4 md:p-12">
    <div class="flex flex-col items-center space-y-6 text-center">
        <h2>Seleziona un esercizio</h2>
        <div class="w-full">
            <livewire:components.select wire:key="exercise"
                                        return="id"
                                        event="itemSelected"
                                        :items="\App\Models\Exercise::all()"
                                        title="name"/>
        </div>
        <div class="flex items-center space-x-5">
            <x-primary-button type="button" color="ghost" wire:click="$emit('closeModal')">Annulla</x-primary-button>
            <x-primary-button color="magenta" wire:click="addExercise">Conferma</x-primary-button>
        </div>
    </div>
</div>
