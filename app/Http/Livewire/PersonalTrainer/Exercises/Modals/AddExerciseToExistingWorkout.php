<?php

namespace App\Http\Livewire\PersonalTrainer\Exercises\Modals;

use App\Models\Exercise;
use App\Models\Repetition;
use App\Models\Workout;
use App\Models\WorkoutDay;
use App\Models\WorkoutSerie;
use App\Models\WorkoutSet;
use App\Models\WorkoutWeek;
use LivewireUI\Modal\ModalComponent;

class AddExerciseToExistingWorkout extends ModalComponent
{
    public Exercise $exercise;
    public $repetitions;
    public $intensity;
    public $selectedWorkout;
    public $selectedWeek;
    public $selectedDay;
    public $selectedSet;
    public $selectedSerie;

    public $workouts = [];
    public $weeks = [];
    public $days = [];
    public $sets = [];
    public $series = [];

    protected $rules = [
        'selectedWorkout' => 'required',
        'selectedWeek' => 'required',
        'selectedDay' => 'required',
        'selectedSet' => 'required',
        'selectedSerie' => 'required',
    ];

    protected $listeners = [
        'workoutCreated'
    ];

    public function workoutCreated($id)
    {
        $this->workouts = auth()->user()->personal_trainer_workouts;
        $this->selectedWorkout = $id;
        $this->updatedSelectedWorkout();
    }

    public function updatedSelectedWorkout()
    {
        $workout = Workout::find($this->selectedWorkout);
        if ($workout) {
            $this->weeks = $workout->workout_weeks;
        } else {
            $this->weeks = [];
        }
        $this->reset(['selectedWeek', 'selectedDay', 'selectedSet', 'selectedSerie']);
        $this->resetValidation();
    }

    public function mount(Exercise $exercise, $repetitions)
    {
        $this->exercise = $exercise;
        $this->repetitions = $repetitions;
        $this->workouts = auth()->user()->personal_trainer_workouts;
    }

    public function updatedSelectedWeek()
    {
        $week = WorkoutWeek::find($this->selectedWeek);
        if ($week) {
            $this->days = $week->workout_days;
        } else {
            $this->days = [];
        }
        $this->reset(['selectedDay', 'selectedSet', 'selectedSerie']);
        $this->resetValidation();
    }

    public function updatedSelectedDay()
    {
        $day = WorkoutDay::find($this->selectedDay);
        if ($day) {
            $this->sets = $day->workout_sets;
        } else {
            $this->sets = [];
        }
        $this->reset(['selectedSet', 'selectedSerie']);
        $this->resetValidation();
    }

    public function updatedSelectedSet()
    {
        $set = WorkoutSet::find($this->selectedSet);
        if ($set) {
            $this->series = $set->workout_series;
        } else {
            $this->series = [];
        }
        $this->reset(['selectedSerie']);
        $this->resetValidation();
    }

    public function addDayToWeek($k)
    {
        $week = WorkoutWeek::find($this->selectedWeek);
        $d = $week->workout_days()->create([
            'workout_id' => $this->selectedWorkout,
            'day' => $k
        ]);
        $this->days = $week->workout_days;
        $this->selectedDay = $d->id;
        $this->resetValidation();
    }

    public function addSetToDay()
    {
        $day = WorkoutDay::find($this->selectedDay);
        $s = $day->workout_sets()->create([
            'workout_id' => $this->selectedWorkout,
            'workout_day_id' => $this->selectedDay
        ]);
        $this->sets = $day->workout_sets;
        $this->selectedSet = $s->id;
        $this->resetValidation();
    }

    public function addSerieToSet()
    {
        $set = WorkoutSet::find($this->selectedSet);
        $s = $set->workout_series()->create([
            'workout_id' => $this->selectedWorkout,
            'workout_set_id' => $this->selectedSet
        ]);
        $this->series = $set->workout_series;
        $this->selectedSerie = $s->id;
        $this->resetValidation();
    }

    public function add()
    {
        $this->validate();

        $serie = WorkoutSerie::find($this->selectedSerie);

        $serie->items()->create([
            'workout_id' => $this->selectedWorkout,
            'item_id' => $this->exercise->id,
            'item_type' => Exercise::class,
            'intensity_id' => $this->intensity
        ]);
        $repetition = Repetition::create([
            'workout_id' => $this->selectedWorkout,
            'workout_week_id' => $this->selectedWeek,
            'quantity' => $this->repetitions
        ]);
        $serie->items()->create([
            'workout_id' => $this->selectedWorkout,
            'item_id' => $repetition->id,
            'item_type' => Repetition::class
        ]);

        $this->emit('item-added', $this->exercise->id);
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.personal-trainer.exercises.modals.add-exercise-to-existing-workout');
    }
}
