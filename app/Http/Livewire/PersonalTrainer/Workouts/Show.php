<?php

namespace App\Http\Livewire\PersonalTrainer\Workouts;

use App\Models\Workout;
use App\Models\WorkoutDay;
use Livewire\Component;

class Show extends Component
{
    public $workout;
    public $athlete;
    public $weeks;
    public $selectedWeek = 1;
    public $selectedDay = null;

    protected $listeners = [
        'day-added' => '$refresh',
    ];

    public function mount(Workout $workout)
    {
        $this->workout = $workout;
        $this->athlete = $workout->athlete;
        $this->weeks = $workout->workout_weeks;
        $this->selectedDay = $workout->workout_days->first()->day ?? null;
    }

    public function addDay($id)
    {
        $day = WorkoutDay::create([
            'workout_id' => $this->workout->id,
            'workout_week_id' => $this->selectedWeek,
            'day' => $id
        ]);

        $this->selectedDay = intval($day->day);
    }

    public function deleteDay(WorkoutDay $day)
    {
        $day->delete();
        $this->selectedDay = null;
    }

    public function render()
    {
        return view('livewire.personal-trainer.workouts.show', [
            'days' => $this->workout->workout_days()->orderBy('day')->get()
        ]);
    }
}
