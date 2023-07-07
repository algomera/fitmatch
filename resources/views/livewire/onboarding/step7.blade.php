<div>
    <div class="prose prose-sm mx-auto">
        <div>
            <h1 class="pt-14 mb-2">Profili online</h1>
            <span>I tuoi contatti social</span>
        </div>
        <div class="mt-6">
            <div class="mt-10 grid grid-cols-1 gap-5">
                <div class="col-span-1">
                    <x-input wire:model="user_informations.instagram" id="instagram" placeholder="Inserisci nome" type="text" name="user_informations.instagram" label="Instagram" autofocus />
                </div>

                <div class="col-span-1">
                    <x-input wire:model="user_informations.facebook" id="facebook" placeholder="Inserisci nome" type="text" name="user_informations.facebook" label="Facebook" autofocus />
                </div>

                <div class="col-span-1">
                    <x-input wire:model="user_informations.website" id="website" placeholder="Inserisci indirizzo" type="text" name="user_informations.website" label="Sito Web" autofocus />
                </div>
            </div>
        </div>
            <div class="not-prose mt-10">
                <x-primary-button wire:click="next">Avanti</x-primary-button>
            </div>
    </div>
</div>
<x-slot:image>
    <img class="aspect-[3/2] w-full bg-gray-50 object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-full"
         src="{{$image}}" alt="">
</x-slot:image>
