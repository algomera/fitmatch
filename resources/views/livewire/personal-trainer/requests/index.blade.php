<x-slot name="header">
    <h2>{{ __('Lista richieste') }}</h2>
</x-slot>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
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
                    @foreach($requests as $request)
                        <tr wire:key="{{ $request->id }}">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                <div class="flex items-center space-x-0 md:space-x-4">
                                    <div class="hidden md:block">
                                        @if($request->informations->profile_image)
                                            <img class="h-8 w-8 rounded-full"
                                                 src="{{ asset($request->informations->profile_image) }}" alt="">
                                        @else
                                            <x-heroicon-o-user-circle class="h-8 w-8"></x-heroicon-o-user-circle>
                                        @endif
                                    </div>
                                    <span>{{ $request->full_name }}</span>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $request->created_at->format('d/m/Y') }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $request->role->label }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                @php
                                    switch ($request->status) {
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
                                <span
                                    class="{{ $badgeClasses }} inline-flex items-center rounded-full px-2 py-1 text-xs text-white font-medium">{{ config('fitmatch.profile_statuses.' . $request->status) }}</span>
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                <a href="{{ route('admin.personal-trainer.show', ['user' => $request->id]) }}"
                                   class="text-indigo-600 hover:text-indigo-900">Vedi profilo</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="my-5">
            {{ $requests->links() }}
        </div>
    </div>
</div>
