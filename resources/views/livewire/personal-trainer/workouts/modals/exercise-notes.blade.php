<div class="select-none bg-fit-lighter-gray p-4 md:p-12">
    <div class="flex flex-col items-center space-y-6 text-center">
        <h2>Note</h2>
        <div class="w-full">
            <x-textarea wire:model.defer="notes" name="notes" id="notes" cols="30" rows="10"></x-textarea>
        </div>
        <x-primary-button wire:click="save">Salva</x-primary-button>
    </div>
</div>
