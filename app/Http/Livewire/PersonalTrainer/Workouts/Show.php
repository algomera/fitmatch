<?php

namespace App\Http\Livewire\PersonalTrainer\Workouts;

use App\Models\Cargo;
use App\Models\Exercise;
use App\Models\Recovery;
use App\Models\Repetition;
use App\Models\Workout;
use App\Models\WorkoutDay;
use App\Models\WorkoutExercise;
use App\Models\WorkoutSerie;
use App\Models\WorkoutSet;
use App\Models\WorkoutWeek;
use Livewire\Component;

class Show extends Component
{
    public $workout;
    public $athlete;
    public $weeks;
    public $selectedWeek = 1;
    public $selectedDay = null;
    public $hasDataToCopy = false;
    public $weekToCopy = null;

    protected $listeners = [
        'day-added' => '$refresh',
        'item-added' => '$refresh',
        'item-deleted' => '$refresh',
    ];

    public function mount(Workout $workout)
    {
        $this->workout = $workout;
        $this->athlete = $workout->athlete;
        $this->weeks = $workout->workout_weeks;
        $this->selectedDay = $workout->workout_days()->orderBy('day')->first()->id ?? null;
    }

    public function copyWeek(WorkoutWeek $week)
    {
        $this->hasDataToCopy = true;
        $this->weekToCopy = $week->id;
    }

    public function pasteWeek()
    {
        $original_week = WorkoutWeek::find($this->weekToCopy);
        $cloned_week = WorkoutWeek::find($this->selectedWeek);

        foreach ($original_week->workout_days as $workout_day) {
            $newDay = $workout_day->replicate()->fill([
                'workout_week_id' => $this->selectedWeek
            ]);
            $newDay->save();
        }


        $this->selectedDay = $cloned_week->workout_days()->orderBy('day')->first()->id ?? null;

        $this->hasDataToCopy = false;
        $this->weekToCopy = null;
    }

    public function addDay($id)
    {
        $day = WorkoutDay::create([
            'workout_id' => $this->workout->id,
            'workout_week_id' => $this->selectedWeek,
            'day' => $id
        ]);

        $set = WorkoutSet::create([
            'workout_id' => $this->workout->id,
            'workout_day_id' => $day->id
        ]);

        $serie = WorkoutSerie::create([
            'workout_id' => $this->workout->id,
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
            foreach ($serie->items as $item) {
                if ($item->item_type !== Exercise::class) {
                    $item->item_type::find($item->item_id)->delete();
                }
            }
            $serie->items()->delete();
            $serie->delete();
        }
        $set->delete();
    }

    public function addRepetition(WorkoutSerie $serie)
    {
        $repetition = Repetition::create();
        $serie->items()->create([
            'workout_id' => $this->workout->id,
            'item_id' => $repetition->id,
            'item_type' => Repetition::class
        ]);
    }

    public function addRecovery(WorkoutSerie $serie)
    {
        $recovery = Recovery::create();
        $serie->items()->create([
            'workout_id' => $this->workout->id,
            'item_id' => $recovery->id,
            'item_type' => Recovery::class
        ]);
    }

    public function addCargo(WorkoutSerie $serie)
    {
        $cargo = Cargo::create();
        $serie->items()->create([
            'workout_id' => $this->workout->id,
            'item_id' => $cargo->id,
            'item_type' => Cargo::class
        ]);
    }

    public function deleteSerie(WorkoutSerie $serie)
    {
        $serie->delete();
    }

    public function addSerie(WorkoutSet $set)
    {
        $set->workout_series()->create([
            'workout_id' => $this->workout->id,
        ]);
    }

    public function addSet($day)
    {
        $set = WorkoutSet::create([
            'workout_id' => $this->workout->id,
            'workout_day_id' => $day
        ]);
        $serie = WorkoutSerie::create([
            'workout_id' => $this->workout->id,
            'workout_set_id' => $set->id
        ]);
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
