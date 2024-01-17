<?php

namespace App\Http\Livewire\PersonalTrainer\Athletes;

use App\Models\User;
use App\Models\Workout;
use App\Models\WorkoutSerieItem;
use App\Models\WorkoutWeek;
use Livewire\Component;

class Performance extends Component
{
    public User $athlete;
    public $workouts = [];
    public $weeks = [];
    public $days = [];
    public $selectedWorkout = "";
    public $selectedWeek = "";
    public $selectedDay = "";
    public $sets = [];
    public $series = [];

    public function mount(User $user)
    {
        $this->athlete = $user;
        if (!in_array($this->athlete->id, auth()->user()->athletes->pluck('id')->toArray())) {
            return abort(404);
        }

        $this->workouts = $this->athlete->athlete_workouts;

        //        $this->selectedWorkout = 1;
        //        $this->updatedSelectedWorkout();
    }

    public function updatedSelectedWorkout()
    {
        $workout = Workout::find($this->selectedWorkout);
        if ($workout) {
            $this->weeks = $workout->workout_weeks()->whereHas('workout_days')->get();
        } else {
            $this->weeks = [];
        }
        $this->reset(['selectedWeek', 'selectedDay']);
    }

    public function updatedSelectedWeek()
    {
        $workout = Workout::find($this->selectedWorkout);
        $week = WorkoutWeek::find($this->selectedWeek);
        if ($week) {
            $this->days = $week->workout_days;
        } else {
            $this->days = [];
        }
        $this->reset(['selectedDay']);
    }

    public function render()
    {
        $items = null;
        if ($this->selectedWorkout) {
            $items = WorkoutSerieItem::query();
            $items->where('workout_id', $this->selectedWorkout);
        }
        if ($this->selectedDay) {

        }

        return view('livewire.personal-trainer.athletes.performance', [
            'items' => $items ? $items->get() : null
        ]);
    }
}
