<div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
    <div class="space-y-5">
        <div>
            <div class="flex items-center justify-between">
                <h3 class="text-fit-purple-blue">Esperienze lavorative</h3>
                <x-primary-button wire:click="$emit('openModal', 'onboarding.step8.modals.create-job', {{ json_encode(['user' => $user->id]) }})">
                    <x-heroicon-o-plus class="w-4 h-4"></x-heroicon-o-plus>
                </x-primary-button>
            </div>
            <div class="divide-y">
                @forelse($job_experiences as $job_experience)
                    <div class="not-prose py-5" wire:key="{{$job_experience->id}}">
                        <div class="flex items-center justify-between">
                            <h3 class="text-fit-black text-xl font-bold">{{ $job_experience->title }}</h3>
                            <div class="flex items-center space-x-4">
                                <svg wire:click="$emit('openModal', 'onboarding.step8.modals.edit-job', {{ json_encode(['job' => $job_experience->id]) }})" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 cursor-pointer hover:text-fit-purple-blue">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-2">
                            <p class="font-bold text-fit-magenta">{{ $job_experience->company }}
                                - {{ $job_experience->city }}</p>
                            <p class="text-fit-black capitalize">{{ \Carbon\Carbon::parse($job_experience->start_date)->monthName }} {{ $job_experience->start_date->format('Y') }}
                                - {{ \Carbon\Carbon::parse($job_experience->end_date)->monthName }} {{ $job_experience->end_date->format('Y') }}</p>
                            <p class="text-fit-dark-gray mt-2">{{ $job_experience->description }}</p>
                        </div>
                    </div>
                @empty
                    <div class="my-5">
                        <p class="text-sm text-fit-dark-gray">Nessun'esperienza lavorativa inserita</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="space-y-5">
        <div>
            <div class="flex items-center justify-between">
                <h3 class="text-fit-purple-blue">Specializzazioni</h3>
                <x-primary-button wire:click="$emit('openModal', 'onboarding.step9.modals.create-specialization', {{ json_encode(['user' => $user->id]) }})">
                    <x-heroicon-o-plus class="w-4 h-4"></x-heroicon-o-plus>
                </x-primary-button>
            </div>
            <div class="divide-y">
                @forelse($specializations as $specialization)
                    <div class="not-prose py-5">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold">{{ $specialization->title }}</h3>
                            <div class="flex items-center space-x-4">
                                <svg wire:click="$emit('openModal', 'onboarding.step9.modals.edit-specialization', {{ json_encode(['specialization' => $specialization->id]) }})" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 cursor-pointer hover:text-fit-purple-blue">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-2">
                            <p class="font-bold text-fit-magenta">{{ $specialization->school }}
                                - {{ $specialization->city }}</p>
                            <p class="capitalize">{{ \Carbon\Carbon::parse($specialization->start_date)->monthName }} {{ $specialization->start_date->format('Y') }}
                                - {{ \Carbon\Carbon::parse($specialization->end_date)->monthName }} {{ $specialization->end_date->format('Y') }}</p>
                            <p class="text-fit-dark-gray mt-2">{{ $specialization->description }}</p>
                        </div>
                    </div>
                @empty
                    <div class="my-5">
                        <p class="text-sm text-fit-dark-gray">Nessuna specializzazione inserita</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
