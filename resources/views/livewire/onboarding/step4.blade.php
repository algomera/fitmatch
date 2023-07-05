<div>
    <div class="prose mx-auto">
        <div>
            <h1 class="pt-14 mb-2 text-3xl font-bold text-fit-black">Informazioni personali</h1>
            <span>I tuoi dati anagrafici</span>
        </div>
        <div class="mt-6 leading-8 text-fit-black">
            <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <x-input-label for="first_name" value="Nome" required />
                    <x-text-input wire:model="user_informations.first_name" id="first_name" class="block mt-1 w-full" type="text" name="first_name" required autofocus />
                    <x-input-error :messages="$errors->get('user_informations.first_name')" class="mt-2" />
                </div>

                <div class="sm:col-span-3">
                    <x-input-label for="last_name" value="Cognome" required />
                    <x-text-input wire:model="user_informations.last_name" id="last_name" class="block mt-1 w-full" type="text" name="last_name" required autofocus />
                    <x-input-error :messages="$errors->get('user_informations.last_name')" class="mt-2" />
                </div>

                <div class="sm:col-span-3">
                    <x-input-label for="dob" value="Data di nascita" required />
                    <x-text-input wire:model="user_informations.dob" id="dob" class="block mt-1 w-full" type="date" name="dob" required autofocus />
                    <x-input-error :messages="$errors->get('user_informations.dob')" class="mt-2" />
                </div>

                <div class="sm:col-span-3">
                    <x-input-label for="phone" value="Numero di telefono" required />
                    <x-text-input wire:model="user_informations.phone" id="phone" class="block mt-1 w-full" type="tel" name="phone" required autofocus />
                    <x-input-error :messages="$errors->get('user_informations.phone')" class="mt-2" />
                </div>

                <div class="sm:col-span-3">
                    <x-input-label for="city" value="Città" required />
                    <x-text-input wire:model="user_informations.city" id="city" class="block mt-1 w-full" type="text" name="city" required autofocus />
                    <x-input-error :messages="$errors->get('user_informations.city')" class="mt-2" />
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
