<div>
    <div class="prose prose-sm mx-auto">
        <div>
            <h1 class="pt-14 mb-2">Informazioni aziendali</h1>
            <span>I dati della tua società</span>
        </div>
        <div class="mt-6">
            <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-6">
                <div class="sm:col-span-6">
                    <x-input wire:model.defer="user_informations.company_name" id="company_name" type="text"
                             name="user_informations.company_name" label="Nome azienda" required autofocus/>
                </div>

                <div class="sm:col-span-4">
                    <x-input wire:model.defer="user_informations.company_address" id="company_address" type="text"
                             name="user_informations.company_address" label="Indirizzo" required autofocus/>
                </div>

                <div class="sm:col-span-2">
                    <x-input wire:model.defer="user_informations.company_civic" id="company_civic" type="text"
                             name="user_informations.company_civic" label="Numero Civico" required autofocus/>
                </div>

                <div class="sm:col-span-4">
                    <x-input wire:model.defer="user_informations.company_city" id="company_city" type="text"
                             name="user_informations.company_city" label="Città" required autofocus/>
                </div>

                <div class="sm:col-span-2">
                    <x-input wire:model.defer="user_informations.company_zip_code" id="company_zip_code" type="text"
                             name="user_informations.company_zip_code" label="CAP" required autofocus/>
                </div>

                <div class="sm:col-span-3">
                    <x-input wire:model.defer="user_informations.company_vat_number" id="company_vat_number" type="text"
                             name="user_informations.company_vat_number" label="Partita IVA" required autofocus/>
                </div>

                <div class="sm:col-span-3">
                    <x-input wire:model.defer="user_informations.company_fiscal_code" id="company_fiscal_code"
                             type="text" name="user_informations.company_fiscal_code" label="Codice Fiscale" autofocus/>
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
