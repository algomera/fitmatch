<a href="{{ route('personal-trainer.workout', $workout->id) }}" class="block bg-white shadow border rounded-md transition-shadow hover:cursor-pointer hover:shadow-lg">
    <div class="p-4 border-b">
        <span class="text-xs text-gray-400">{{ $workout->start_date->format('d/m/Y') }} - {{ $workout->end_date->format('d/m/Y') }}</span>
        <p class="text-lg font-bold text-fit-black mt-1">{{ $workout->name }}</p>
    </div>
    <div class="p-4 border-b bg-gray-100">
        <span class="font-semibold text-fit-dark-blue">12 training sessions</span>
    </div>
    <div class="p-4 flex items-center justify-between">
        <x-heroicon-o-arrow-up-on-square class="w-5 h-5 hover:cursor-pointer hover:text-fit-magenta"></x-heroicon-o-arrow-up-on-square>
        <div class="flex space-x-4">
            <x-heroicon-o-trash class="w-5 h-5 hover:cursor-pointer hover:text-fit-magenta"></x-heroicon-o-trash>
            <x-heroicon-o-square-2-stack class="w-5 h-5 hover:cursor-pointer hover:text-fit-magenta"></x-heroicon-o-square-2-stack>
        </div>
    </div>
</a>
