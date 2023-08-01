<?php

namespace App\Http\Livewire\PersonalTrainer\Workouts;

use App\Models\Workout;
use App\Models\WorkoutDay;
use App\Models\WorkoutExercise;
use App\Models\WorkoutSerie;
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

        $set = WorkoutSet::create([
            'workout_day_id' => $day->id
        ]);

        $serie = WorkoutSerie::create([
            'workout_set_id' => $set->id
        ]);

        $this->selectedDay = $day->id;
    }

    public function deleteDay(WorkoutDay $day)
    {
        foreach ($day->workout_sets as $set) {
            $this->deleteSet($set);
        }
        $day->workout_sets()->delete();
        $day->delete();
        $this->selectedDay = $this->workout->workout_days()->where('workout_week_id', $this->selectedWeek)->first()->id ?? null;
    }

    public function deleteSet(WorkoutSet $set)
    {
        foreach ($set->workout_series as $serie) {
            $serie->exercises()->detach();
            $serie->delete();
        }
        $set->delete();
    }

    public function addSet($day)
    {
        $set = WorkoutSet::create([
            'workout_day_id' => $day
        ]);
        $serie = WorkoutSerie::create([
            'workout_set_id' => $set->id
        ]);
    }

    public function addExercise(WorkoutSerie $serie)
    {
        $serie->exercises()->attach(1);
    }

    public function addSerie(WorkoutSet $set)
    {
        $set->workout_series()->create();
    }

    public function deleteSerie(WorkoutSerie $serie)
    {
        $serie->delete();
    }

    public function updatedSelectedWeek()
    {
        $this->selectedDay = $this->workout->workout_days()->where('workout_week_id', $this->selectedWeek)->first()->id ?? null;
    }

    public function render()
    {
        return view('livewire.personal-trainer.workouts.show', [
            'days' => $this->workout->workout_days()->where('workout_week_id', $this->selectedWeek)->orderBy('day')->get(),
            'sets' => WorkoutSet::where('workout_day_id', $this->selectedDay)->get(),
        ]);
    }
}
