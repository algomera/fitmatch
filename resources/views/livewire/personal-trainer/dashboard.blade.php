<x-slot name="header">
    <span>Bentornato</span>
    <h2>{{ auth()->user()->full_name }}</h2>
</x-slot>

<div class="max-w-7xl mx-auto py-6 pt-0 px-4 sm:px-6 lg:px-8">
    <div class="space-y-8">
        <div>
            <dl class="grid grid-cols-1 divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow md:grid-cols-3 md:divide-x md:divide-y-0">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-base font-normal text-gray-900">Atleti</dt>
                    <dd class="mt-1 flex items-center justify-between md:block lg:flex">
                        <div class="flex items-baseline text-2xl font-semibold text-fit-purple-blue">
                            {{ $athletes->count() }}
                        </div>
                        <x-primary-button href="{{ route('personal-trainer.athletes') }}">Vedi</x-primary-button>
                    </dd>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-base font-normal text-gray-900">Schede</dt>
                    <dd class="mt-1 flex items-center justify-between md:block lg:flex">
                        <div class="flex items-baseline text-2xl font-semibold text-fit-purple-blue">
                            {{ $workouts_count }}
                        </div>
                        <x-primary-button href="{{ route('personal-trainer.workouts') }}">Vedi</x-primary-button>
                    </dd>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-base font-normal text-gray-900">Esercizi</dt>
                    <dd class="mt-1 flex items-center justify-between md:block lg:flex">
                        <div class="flex items-baseline text-2xl font-semibold text-fit-purple-blue">
                            {{ $exercises->count() }}
                        </div>
                        <x-primary-button>Vedi</x-primary-button>
                    </dd>
                </div>
            </dl>
        </div>
        @if($assigned_workouts->count() > 0)
            <div>
                <div class="flex items-center justify-between">
                    <h3 class="text-fit-magenta">Ultime schede create</h3>
                    <x-primary-button href="{{ route('personal-trainer.workouts') }}" color="link">Vedi tutte
                    </x-primary-button>
                </div>
                <div class="mt-2 grid grid-cols-4 gap-4">
                    @foreach($assigned_workouts as $workout)
                        <livewire:components.workout :workout="$workout" wire:key="assigned-{{ $workout->id }}"/>
                    @endforeach
                </div>
            </div>
        @endif
        @if($not_assigned_workouts->count() > 0)
            <div>
                <div class="flex items-center justify-between">
                    <h3 class="text-fit-magenta">Schede non assegnate</h3>
                    <x-primary-button href="{{ route('personal-trainer.workouts', ['filter' => 'unassigned']) }}"
                                      color="link">Vedi tutte
                    </x-primary-button>
                </div>
                <div class="mt-2 grid grid-cols-4 gap-4">
                    @foreach($not_assigned_workouts as $workout)
                        <livewire:components.workout :workout="$workout" wire:key="not_assigned-{{ $workout->id }}"/>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
