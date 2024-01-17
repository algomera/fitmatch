<form wire:submit.prevent="save" class="bg-fit-lighter-gray p-4 md:p-12">
    <div class="space-y-6">
        <h1>Specializzazione</h1>
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-6">
            <div class="col-span-6 sm:col-span-6">
                <x-input wire:model="specialization.title" id="title" type="text" name="specialization.title"
                         label="Titolo" required autofocus/>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input wire:model="specialization.school" id="school" type="text" name="specialization.school"
                         label="Scuola" required autofocus/>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input wire:model="specialization.city" id="city" type="text" name="specialization.city" label="Città"
                         required autofocus/>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input wire:model="specialization.start_date" id="start_date" type="date"
                         name="specialization.start_date" label="Data di inizio" required autofocus/>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input wire:model="specialization.end_date" id="end_date" type="date" name="specialization.end_date"
                         label="Data di fine" required autofocus/>
            </div>

            <div class="col-span-6">
                <x-textarea wire:model="specialization.description" id="description"
                            rows="6"
                            name="specialization.description"
                            label="Descrizione"
                />
            </div>
        </div>
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-5">
                <x-primary-button type="button" color="ghost" wire:click="$emit('closeModal')">Annulla
                </x-primary-button>
                <x-primary-button color="magenta">Salva</x-primary-button>
            </div>
            <x-primary-button type="button" color="red" wire:click="delete">Elimina</x-primary-button>
        </div>
    </div>
</form>
