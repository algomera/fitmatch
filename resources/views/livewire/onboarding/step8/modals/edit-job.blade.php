<form wire:submit.prevent="save" class="bg-fit-lighter-gray p-4 md:p-12">
    <div class="space-y-6">
        <h1 class="text-3xl font-bold text-fit-black">Posizione lavorativa</h1>
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-6">
            <div class="col-span-6 sm:col-span-6">
                <x-input wire:model="job.title" id="title" type="text" name="job.title" label="Titolo" required autofocus />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input wire:model="job.company" id="company" type="text" name="job.company" label="Azienda" required autofocus />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input wire:model="job.city" id="city" type="text" name="job.city" label="Città" required autofocus />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input wire:model="job.start_date" id="start_date" type="date" name="job.start_date" label="Data di inizio" required autofocus />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input wire:model="job.end_date" id="end_date" type="date" name="job.end_date" label="Data di fine" required autofocus />
            </div>

            <div class="col-span-6">
                <x-textarea wire:model="job.description" id="description"
                            rows="6"
                            name="job.description"
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
