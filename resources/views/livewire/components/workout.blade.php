<a href="{{ route('personal-trainer.workout', $workout->id) }}"
   class="block bg-white shadow border rounded-md transition-shadow hover:cursor-pointer hover:shadow-lg">
    <div class="p-4 border-b">
        @if($workout->start_date)
            <span
                class="text-xs text-gray-400">{{ $workout->start_date->format('d/m/Y') }} - {{ $workout->end_date->format('d/m/Y') }}</span>
        @else
            <div class="h-6"></div>
        @endif
        <p class="text-lg font-fit-bold text-fit-black mt-1">{{ $workout->name }}</p>
        @if($workout->athlete)
            <span class="text-xs font-semibold text-gray-500">{{ $workout->athlete->full_name }}</span>
        @else
            <div class="h-6"></div>
        @endif
    </div>
    <div class="p-4 border-b bg-gray-100">
        <span class="font-semibold text-fit-dark-blue">{{ $workout->workout_days->count() }} training sessions</span>
    </div>
    <div class="p-4 flex items-center justify-between">
        <x-heroicon-o-arrow-up-on-square
            wire:click.prevent="$emit('openModal', 'workouts.modals.share', {{ json_encode(['workout' => $workout->id]) }})"
            class="w-5 h-5 hover:cursor-pointer hover:text-fit-magenta"></x-heroicon-o-arrow-up-on-square>
        <div class="flex space-x-4">
            <x-heroicon-o-trash
                wire:click.prevent="$emit('openModal', 'workouts.modals.delete-workout', {{ json_encode(['workout' => $workout->id]) }})"
                class="w-5 h-5 hover:cursor-pointer hover:text-fit-magenta"></x-heroicon-o-trash>
            <x-heroicon-o-square-2-stack
                wire:click.prevent="$emit('openModal', 'workouts.modals.duplicate-workout', {{ json_encode(['workout' => $workout->id]) }})"
                class="w-5 h-5 hover:cursor-pointer hover:text-fit-magenta"></x-heroicon-o-square-2-stack>
        </div>
    </div>
</a>
