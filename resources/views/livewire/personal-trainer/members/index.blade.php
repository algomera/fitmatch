<x-slot name="header">
    <h2>{{ __('Lista iscritti') }}</h2>
</x-slot>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- filtri --}}
    <div class="flex items-center space-x-4">
        <div class="w-full max-w-lg">
            <x-input wire:model.debounce="search" type="text" label="Cerca" placeholder="Cerca.."/>
        </div>
        <x-select wire:model="role" label="Ruolo">
            <option value="">Seleziona</option>
            @foreach(\Spatie\Permission\Models\Role::whereNot('name', 'admin')->get() as $role)
                <option value="{{ $role->name }}">{{ $role->label }}</option>
            @endforeach
        </x-select>
        <x-select wire:model="status" label="Stato">
            <option value="">Seleziona</option>
            @foreach(config('fitmatch.profile_statuses') as $k => $status)
                <option value="{{ $k }}">{{ $status }}</option>
            @endforeach
        </x-select>
    </div>
    <div class="mt-8 flow-root">
        @if($members->count())
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                        <tr>
                            <th scope="col"
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                Nome
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Data
                                richiesta
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Ruolo</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Stato</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0"></th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @foreach($members as $member)
                            <tr wire:key="{{ $member->id }}">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-fit-medium text-gray-900 sm:pl-0">
                                    <div class="flex items-center space-x-0 md:space-x-4">
                                        <div class="hidden md:block">
                                            @if($member->avatar())
                                                <img class="h-8 w-8 rounded-full"
                                                     src="{{ $member->avatar() }}" alt="">
                                            @else
                                                <x-heroicon-o-user-circle class="h-8 w-8"></x-heroicon-o-user-circle>
                                            @endif
                                        </div>
                                        <span>{{ $member->full_name }}</span>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $member->created_at->format('d/m/Y') }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $member->role->label }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    @php
                                        switch ($member->status) {
                                            case 'pending':
                                            $badgeClasses = 'bg-fit-magenta';
                                            break;
                                            case 'approved':
                                            $badgeClasses = 'bg-fit-light-blue';
                                            break;
                                            case 'rejected':
                                            $badgeClasses = 'bg-gray-500';
                                            break;
                                            case 'blocked':
                                            $badgeClasses = 'bg-red-500';
                                            break;
                                        }
                                    @endphp
                                    @if($member->status)
                                        <span
                                            class="{{ $badgeClasses }} inline-flex items-center rounded-full px-2 py-1 text-xs text-white font-fit-medium">{{ config('fitmatch.profile_statuses.' . $member->status) }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                @if($member->role->name === 'personal-trainer')
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-fit-medium sm:pr-0">
                                        <a href="{{ route('admin.personal-trainer.show', ['user' => $member->id]) }}"
                                           class="text-indigo-600 hover:text-indigo-900">Vedi profilo</a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="my-5">
                {{ $members->links() }}
            </div>
        @else
            <p>Nessun risultato trovato</p>
        @endif
    </div>
</div>
