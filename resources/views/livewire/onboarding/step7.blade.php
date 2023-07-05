<div>
    <div class="prose mx-auto">
        <div>
            <h1 class="pt-14 mb-2 text-3xl font-bold text-fit-black">Profili online</h1>
            <span>I tuoi contatti social</span>
        </div>
        <div class="mt-6 leading-8 text-fit-black">
            <div class="mt-10 grid grid-cols-1 gap-5">
                <div class="col-span-1">
                    <x-input-label for="instagram" value="Instagram" />
                    <x-text-input wire:model="user_informations.instagram" id="instagram" placeholder="Inserisci nome" class="block mt-1 w-full" type="text" name="instagram" autofocus />
                    <x-input-error :messages="$errors->get('user_informations.instagram')" class="mt-2" />
                </div>

                <div class="col-span-1">
                    <x-input-label for="last_name" value="Facebook" />
                    <x-text-input wire:model="user_informations.facebook" id="facebook" placeholder="Inserisci nome" class="block mt-1 w-full" type="text" name="facebook" autofocus />
                    <x-input-error :messages="$errors->get('user_informations.facebook')" class="mt-2" />
                </div>

                <div class="col-span-1">
                    <x-input-label for="dob" value="Sito web" />
                    <x-text-input wire:model="user_informations.website" id="website" placeholder="Inserisci indirizzo" class="block mt-1 w-full" type="text" name="website" autofocus />
                    <x-input-error :messages="$errors->get('user_informations.website')" class="mt-2" />
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
