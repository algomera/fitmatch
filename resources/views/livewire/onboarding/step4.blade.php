<div>
    <div class="prose prose-sm mx-auto">
        <div>
            <h1 class="pt-14 mb-2">Informazioni personali</h1>
            <span>I tuoi dati anagrafici</span>
        </div>
        <div class="mt-6">
            <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <x-input wire:model="user_informations.first_name" id="first_name" type="text" name="user_informations.first_name" label="Nome" required autofocus />
                </div>

                <div class="sm:col-span-3">
                    <x-input wire:model="user_informations.last_name" id="last_name" type="text" name="user_informations.last_name" label="Cognome" required autofocus />
                </div>

                <div class="sm:col-span-3">
                    <x-input wire:model="user_informations.dob" id="dob" type="date" name="user_informations.dob" label="Data di nascita" required autofocus />
                </div>

                <div class="sm:col-span-3">
                    <x-input wire:model="user_informations.phone" id="phone" type="tel" name="user_informations.phone" label="Numero di telefono" required autofocus />
                </div>

                <div class="sm:col-span-3">
                    <x-input wire:model="user_informations.city" id="city" type="text" name="user_informations.city" label="Città" required autofocus />
                </div>
            </div>
        </div>
            <div class="not-prose mt-10">
                <x-primary-button wire:click="next" class="!px-14">Avanti</x-primary-button>
            </div>
    </div>
</div>
<x-slot:image>
    <img class="aspect-[3/2] w-full bg-gray-50 object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-full"
         src="{{$image}}" alt="">
</x-slot:image>
