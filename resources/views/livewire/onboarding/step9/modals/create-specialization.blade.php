<form wire:submit.prevent="save" class="bg-fit-lighter-gray p-4 md:p-12">
    <div class="space-y-6">
        <h1>Specializzazione</h1>
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-6">
            <div class="col-span-6 sm:col-span-6">
                <x-input wire:model="title" id="title" type="text" name="title" label="Titolo" required autofocus />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input wire:model="school" id="school" type="text" name="school" label="Scuola" required autofocus />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input wire:model="city" id="city" type="text" name="city" label="Città" required autofocus />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input wire:model="start_date" id="start_date" type="date" name="start_date" label="Data di inizio" required autofocus />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input wire:model="end_date" id="end_date" type="date" name="end_date" label="Data di fine" required autofocus />
            </div>

            <div class="col-span-6">
                <x-textarea wire:model="description" id="description"
                            rows="6"
                            name="description"
                            label="Descrizione"
                />
            </div>
        </div>
        <div class="flex items-center space-x-5">
            <x-primary-button type="button" color="ghost" wire:click="$emit('closeModal')">Annulla</x-primary-button>
            <x-primary-button color="magenta">Salva</x-primary-button>
        </div>
    </div>
</form>
