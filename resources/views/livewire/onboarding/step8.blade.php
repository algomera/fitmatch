<div>
    <div class="prose mx-auto">
        <div>
            <h1 class="pt-14 mb-2 text-3xl font-bold text-fit-black">Esperienze lavorative</h1>
        </div>
        @if($job_experiences->count() <= 0)
            <div class="mt-6 leading-8 text-fit-black">
                <div class="flex items-center space-x-10 mt-10">
                    <x-fit-tertiary-button wire:click="skip" class="!px-14">Salta</x-fit-tertiary-button>
                    <x-primary-button wire:click="$emit('openModal', 'onboarding.create-job')" class="!px-14">Aggiungi
                    </x-primary-button>
                </div>
            </div>
        @else
            <div>
                <div class="divide-y">
                    @foreach($job_experiences as $job_experience)
                        <div class="not-prose py-5">
                            <div class="flex items-center justify-between">
                                <h3 class="text-fit-black text-xl font-bold">{{ $job_experience->title }}</h3>
                                <div class="flex items-center space-x-4">
                                    <svg wire:click="$emit('openModal', 'onboarding.step8.modals.edit-job', {{ json_encode(['job' => $job_experience->id]) }})" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                    <svg wire:click="$emit('openModal', 'onboarding.step8.modals.delete-job', {{ json_encode(['job' => $job_experience->id]) }})" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
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
                    @endforeach
                </div>
                <div class="flex items-center space-x-10 mt-10">
                    <x-fit-secondary-button wire:click="$emit('openModal', 'onboarding.step8.modals.create-job')" class="!px-14">Aggiungi</x-fit-secondary-button>
                    <x-primary-button wire:click="next" class="!px-14">Avanti</x-primary-button>
                </div>
            </div>
        @endif
    </div>
</div>
<x-slot:image>
    <img class="aspect-[3/2] w-full bg-gray-50 object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-full"
         src="{{$image}}" alt="">
</x-slot:image>
