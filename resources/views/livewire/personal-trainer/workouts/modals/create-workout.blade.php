<div class="bg-fit-lighter-gray p-4 md:p-12">
    <div class="space-y-6">
        <h2>Nuova scheda</h2>
        <div class="w-full">
            <div class="grid grid-cols-2 gap-5">
                <div class="col-span-2">
                    <x-input wire:model="name" id="name" type="text" name="name" label="Titolo" required/>
                </div>
                <div class="col-span-2">
                    <x-input-label class="font-semibold">Tipologia scheda <span class="text-red-500">*</span>
                    </x-input-label>
                    <div class="mt-1 space-y-4 sm:flex sm:items-center sm:space-x-10 sm:space-y-0">
                        <div class="flex items-center">
                            <input wire:model="workout_type" id="athlete" name="workout_type" type="radio"
                                   value="athlete" checked
                                   class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="athlete"
                                   class="ml-3 block text-sm font-medium leading-6 text-gray-900">Atleta</label>
                        </div>
                        <div class="flex items-center">
                            <input wire:model="workout_type" id="unassigned" name="workout_type" type="radio"
                                   value="unassigned"
                                   class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="unassigned" class="ml-3 block text-sm font-medium leading-6 text-gray-900">Non
                                assegnata</label>
                        </div>
                    </div>
                </div>
                <x-select wire:model="duration" name="duration" id="duration" label="Durata (in settimane)" required>
                    @foreach(range(1, 10) as $duration)
                        <option value="{{ $duration }}">{{ $duration }}</option>
                    @endforeach
                </x-select>
                @if($workout_type === 'athlete')
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
                @else
                    <div></div>
                @endif
                <x-input wire:model="start_date" id="start_date" type="date" name="start_date" label="Data" required/>
                <x-select wire:model="goal_id" name="goal" id="goal" label="Obbiettivo" required>
                    <option value="">Seleziona</option>
                    @foreach($goals as $goal)
                        <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                    @endforeach
                </x-select>
            </div>
        </div>
        <div class="flex justify-end space-x-5">
            {{--            <x-primary-button type="button" color="ghost" wire:click="$emit('closeModal')">Annulla</x-primary-button>--}}
            <x-primary-button color="blue" wire:click="save">Salva</x-primary-button>
        </div>
    </div>
</div>
