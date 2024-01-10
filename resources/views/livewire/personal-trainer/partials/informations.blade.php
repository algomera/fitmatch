<div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
    <div class="space-y-5">
        <div>
            <h3 class="text-fit-purple-blue">Informazioni personali</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-5">
                <div class="col-span-2 sm:col-span-1">
                    <x-input wire:model="user.informations.dob" type="date" name="user.informations.dob"
                             label="Data di nascita"></x-input>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <x-input wire:model="user.informations.phone" type="tel" name="user.informations.phone"
                             label="Numero di telefono"></x-input>
                </div>
                <div class="col-span-2">
                    <x-input wire:model="user.email" type="email" name="user.email" label="Email"></x-input>
                </div>
            </div>
        </div>
        <div>
            <h3 class="text-fit-purple-blue">Biografia</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-5">
                <div class="col-span-2">
                    <x-textarea wire:model="user.informations.bio" name="user.informations.bio" rows="10"/>
                </div>
            </div>
        </div>
    </div>
    <div class="space-y-5">
        <div>
            <h3 class="text-fit-purple-blue">Informazioni aziendali</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-5">
                <div class="col-span-3">
                    <x-input wire:model="user.informations.company_name" type="text"
                             name="user.informations.company_name" label="Nome azienda"></x-input>
                </div>
                <div class="col-span-2 sm:col-span-2">
                    <x-input wire:model="user.informations.company_address" type="text"
                             name="user.informations.company_address" label="Indirizzo"></x-input>
                </div>
                <div class="col-span-1">
                    <x-input wire:model="user.informations.company_civic" type="text"
                             name="user.informations.company_civic" label="Numero Civico"></x-input>
                </div>
                <div class="col-span-2 sm:col-span-2">
                    <x-input wire:model="user.informations.company_city" type="text"
                             name="user.informations.company_city" label="Città"></x-input>
                </div>
                <div class="col-span-1">
                    <x-input wire:model="user.informations.company_zip_code" type="text"
                             name="user.informations.company_zip_code" label="CAP"></x-input>
                </div>
                <div class="col-span-3">
                    <x-input wire:model="user.informations.company_vat_number" type="text"
                             name="user.informations.company_vat_number" label="Partita IVA"></x-input>
                </div>
                <div class="col-span-3">
                    <x-input wire:model="user.informations.company_fiscal_code" type="text"
                             name="user.informations.company_fiscal_code" label="Codice Fiscale"></x-input>
                </div>
            </div>
        </div>
    </div>
    <x-primary-button wire:click="save" class="justify-center w-min">Salva</x-primary-button>
</div>
