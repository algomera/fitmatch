<form wire:submit.prevent="save" class="bg-fit-lighter-gray p-4 md:p-12">
    <div class="space-y-6">
        <h1 class="text-3xl font-bold text-fit-black">Specializzazione</h1>
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-6">
            <div class="col-span-6 sm:col-span-6">
                <x-input-label for="title" value="Titolo" required />
                <x-text-input wire:model="specialization.title" id="title" class="block mt-1 w-full" type="text" name="title" required autofocus />
                <x-input-error :messages="$errors->get('specialization.title')" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-label for="school" value="Scuola" required />
                <x-text-input wire:model="specialization.school" id="school" class="block mt-1 w-full" type="text" name="school" required autofocus />
                <x-input-error :messages="$errors->get('specialization.school')" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-label for="city" value="Città" required />
                <x-text-input wire:model="specialization.city" id="city" class="block mt-1 w-full" type="text" name="city" required autofocus />
                <x-input-error :messages="$errors->get('specialization.city')" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-label for="start_date" value="Data di inizio" required />
                <x-text-input wire:model="specialization.start_date" id="start_date" class="block mt-1 w-full" type="date" name="start_date" required autofocus />
                <x-input-error :messages="$errors->get('specialization.start_date')" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-label for="end_date" value="Data di fine" required />
                <x-text-input wire:model="specialization.end_date" id="end_date" class="block mt-1 w-full" type="date" name="end_date" required autofocus />
                <x-input-error :messages="$errors->get('specialization.end_date')" class="mt-2" />
            </div>

            <div class="col-span-6">
                <x-input-label for="description" value="Descrizione" />
                    <textarea wire:model="specialization.description" id="description"
                              rows="6"
                              class="w-full mt-1 border-0 focus:border-fit-light-blue focus:ring-fit-light-blue rounded-xl shadow-sm"
                              type="text" name="description"></textarea>
                <x-input-error :messages="$errors->get('specialization.description')" class="mt-2"/>
            </div>
        </div>
        <div class="flex items-center space-x-10">
            <x-fit-tertiary-button>Annulla</x-fit-tertiary-button>
            <x-fit-secondary-button>Salva</x-fit-secondary-button>
        </div>
    </div>
</form>
