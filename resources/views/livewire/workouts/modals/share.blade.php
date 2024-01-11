<div>
    <div class="px-4 py-3.5 font-semibold border-b">Condividi</div>
    <div class="p-4">
        <fieldset class="mt-4">
            <div class="space-y-4">
                <div class="flex items-center">
                    <input wire:model="sharing_method" id="pdf" value="pdf" name="sharing-method" type="radio"
                           class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    <label for="pdf" class="ml-3 block text-sm font-medium leading-6 text-gray-900">
                        Esporta in PDF
                    </label>
                </div>
                <div class="flex items-center">
                    <input wire:model="sharing_method" id="email" value="email" name="sharing-method" type="radio"
                           class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    <label for="email" class="ml-3 block text-sm font-medium leading-6 text-gray-900">
                        Invia tramite email
                    </label>
                </div>
            </div>
        </fieldset>
        @if($sharing_method === 'email')
            <div class="mt-3">
                <x-input wire:model.defer="to" name="to" type="email"
                         class="shadow-none rounded-md ring-1 ring-inset ring-gray-300"
                         placeholder="email@example.com"/>
            </div>

        @endif
    </div>
    <div class="flex justify-end px-4 py-3.5 font-semibold border-t">
        @if($sharing_method === 'pdf')
            <x-primary-button wire:click="share">Esporta</x-primary-button>
        @elseif($sharing_method === 'email')
            <x-primary-button wire:click="share">Invia</x-primary-button>
        @endif
    </div>
</div>
