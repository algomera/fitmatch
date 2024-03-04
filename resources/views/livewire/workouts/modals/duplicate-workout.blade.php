<div class="bg-fit-lighter-gray p-4 md:p-12">
    <div class="flex flex-col items-center space-y-6 text-center">
        <h2>Vuoi duplicare questa scheda?</h2>
        <div class="space-y-2">
            <h3>Vuoi assegnare la scheda che stai duplicando ad un atleta?</h3>
            <div class="flex items-center justify-center space-x-3">
                <div
                    wire:click="$set('assign', true)"
                    class="w-full max-w-[200px] px-4 py-2 rounded-md text-sm text-center font-semibold {{ $assign === true ? 'bg-fit-magenta text-white' : 'bg-gray-200 hover:bg-gray-300 cursor-pointer' }}">
                    SI
                </div>
                <div
                    wire:click="$set('assign', false)"
                    class="w-full max-w-[200px] px-4 py-2 rounded-md text-sm text-center font-semibold {{ $assign === false ? 'bg-fit-magenta text-white' : 'bg-gray-200 hover:bg-gray-300 cursor-pointer' }}">
                    NO
                </div>
            </div>
            <div class="col-span-2">
                <x-input wire:model="name" id="name" type="text" name="name" label="Titolo" required/>
            </div>
            @if($assign)
                <div class="grid grid-cols-2 gap-5">
                    <livewire:components.select
                        wire:key="athlete_id"
                        name="athlete_id"
                        return="id"
                        event="itemSelected"
                        :items="auth()->user()->athletes()->with('informations')->get()"
                        title="full_name"
                        subtitle="email"
                        label="Atleta"
                        required
                    />
                    <x-input wire:model="start_date" id="start_date" type="date" name="start_date" label="Data"
                             required/>
                    <x-select wire:model="goal_id" name="goal" id="goal" label="Obbiettivo" required>
                        <option value="">Seleziona</option>
                        @foreach($goals as $goal)
                            <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                        @endforeach
                    </x-select>
                </div>
            @endif
        </div>
        <div class="flex items-center space-x-5">
            <x-primary-button type="button" color="ghost" wire:click="$emit('closeModal')">Annulla</x-primary-button>
            <x-primary-button color="magenta" wire:click="duplicate">Duplica</x-primary-button>
        </div>
    </div>
</div>
