<?php

namespace App\Http\Livewire\PersonalTrainer\Workouts\Modals;

use App\Models\Workout;
use App\Models\WorkoutDay;
use App\Models\WorkoutSerie;
use App\Models\WorkoutSet;
use App\Models\WorkoutWeek;
use LivewireUI\Modal\ModalComponent;

class AddExercises extends ModalComponent
{
    public Workout $workout;
    public WorkoutWeek $week;
    public WorkoutDay $day;
    public WorkoutSerie $serie;

    public static function modalMaxWidthClass(): string
    {
        return 'sm:max-w-[98vw] sm:min-h-[850px] sm:max-h-[92vh]';
    }

    public function mount(Workout $workout, WorkoutWeek $week, WorkoutDay $day, WorkoutSet $set, WorkoutSerie $serie)
    {
        $this->workout = $workout;
        $this->week = $week;
        $this->day = $day;
        $this->serie = $serie;
    }

    public function render()
    {
        return view('livewire.personal-trainer.workouts.modals.add-exercises');
    }
}
