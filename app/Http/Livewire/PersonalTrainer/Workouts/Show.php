<?php

namespace App\Http\Livewire\PersonalTrainer\Workouts;

use App\Models\Workout;
use App\Models\WorkoutDay;
use App\Models\WorkoutSet;
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
        $this->selectedDay = $workout->workout_days()->orderBy('day')->first()->id ?? null;
    }

    public function addDay($id)
    {
        $day = WorkoutDay::create([
            'workout_id' => $this->workout->id,
            'workout_week_id' => $this->selectedWeek,
            'day' => $id
        ]);

        WorkoutSet::create([
            'workout_day_id' => $day->id
        ]);

        $this->selectedDay = $day->id;
    }

    public function deleteDay(WorkoutDay $day)
    {
        $day->workout_sets()->delete();
        $day->delete();
        $this->selectedDay = null;
    }

    public function addSet($day)
    {
        WorkoutSet::create([
            'workout_day_id' => $day
        ]);
    }

    public function deleteSet(WorkoutSet $set)
    {
        $set->delete();
    }

    public function render()
    {
        return view('livewire.personal-trainer.workouts.show', [
            'days' => $this->workout->workout_days()->orderBy('day')->get(),
            'sets' => WorkoutSet::where('workout_day_id', $this->selectedDay)->get()
        ]);
    }
}
