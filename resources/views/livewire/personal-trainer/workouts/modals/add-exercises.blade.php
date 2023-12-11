<div class="relative overflow-hidden">
    <div>
        <div class="grid grid-cols-4 gap-8">
            <div class="col-span-1 p-4">
                Workout: {{ $workout->id }}<br>
                Week: {{ $week->id }}<br>
                Day: {{$day->id}}<br>
                Serie: {{$serie->id}}
            </div>
            <div class="col-span-3 h-[calc(100vh-6.7rem)] overflow-y-scroll divide-y pt-4 pb-14">
                @foreach($exercises as $exercise)
                    <livewire:components.exercise-item :exercise="$exercise->id" :wire:key="$exercise->id"/>
                @endforeach
            </div>
        </div>
    </div>
    <div class="absolute -bottom-4 w-full bg-white py-4 px-4">
        {{ $exercises->links() }}
    </div>
</div>
