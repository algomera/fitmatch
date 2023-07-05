<div>
    <div class="prose mx-auto">
        <div>
            <h1 class="pt-14 mb-2 text-3xl font-bold text-fit-black">Informazioni aziendali</h1>
            <span>I dati della tua società</span>
        </div>
        <div class="mt-6 leading-8 text-fit-black">
            <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-6">
                <div class="sm:col-span-6">
                    <x-input-label for="company_name" value="Nome azienda" required />
                    <x-text-input wire:model="user_informations.company_name" id="company_name" class="block mt-1 w-full" type="text" name="company_name" required autofocus />
                    <x-input-error :messages="$errors->get('user_informations.company_name')" class="mt-2" />
                </div>

                <div class="sm:col-span-4">
                    <x-input-label for="company_address" value="Indirizzo" required />
                    <x-text-input wire:model="user_informations.company_address" id="company_address" class="block mt-1 w-full" type="text" name="company_address" required autofocus />
                    <x-input-error :messages="$errors->get('user_informations.company_address')" class="mt-2" />
                </div>

                <div class="sm:col-span-2">
                    <x-input-label for="company_civic" value="Numero Civico" required />
                    <x-text-input wire:model="user_informations.company_civic" id="company_civic" class="block mt-1 w-full" type="text" name="company_civic" required autofocus />
                    <x-input-error :messages="$errors->get('user_informations.company_civic')" class="mt-2" />
                </div>

                <div class="sm:col-span-4">
                    <x-input-label for="company_city" value="Città" required />
                    <x-text-input wire:model="user_informations.company_city" id="company_city" class="block mt-1 w-full" type="text" name="company_city" required autofocus />
                    <x-input-error :messages="$errors->get('user_informations.company_city')" class="mt-2" />
                </div>

                <div class="sm:col-span-2">
                    <x-input-label for="company_zip_code" value="CAP" required />
                    <x-text-input wire:model="user_informations.company_zip_code" id="company_zip_code" class="block mt-1 w-full" type="text" name="company_zip_code" required autofocus />
                    <x-input-error :messages="$errors->get('user_informations.company_zip_code')" class="mt-2" />
                </div>

                <div class="sm:col-span-3">
                    <x-input-label for="company_vat_number" value="Partita Iva" required />
                    <x-text-input wire:model="user_informations.company_vat_number" id="company_vat_number" class="block mt-1 w-full" type="text" name="company_vat_number" required autofocus />
                    <x-input-error :messages="$errors->get('user_informations.company_vat_number')" class="mt-2" />
                </div>

                <div class="sm:col-span-3">
                    <x-input-label for="company_fiscal_code" value="Codice Fiscale" />
                    <x-text-input wire:model="user_informations.company_fiscal_code" id="company_fiscal_code" class="block mt-1 w-full" type="text" name="company_fiscal_code" autofocus />
                    <x-input-error :messages="$errors->get('user_informations.company_fiscal_code')" class="mt-2" />
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
