<?php

namespace App\Http\Livewire\PersonalTrainer\Workouts\Modals;

use App\Models\Exercise;
use App\Models\Repetition;
use App\Models\Workout;
use App\Models\WorkoutDay;
use App\Models\WorkoutSerie;
use App\Models\WorkoutSet;
use App\Models\WorkoutWeek;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;

class AddExercises extends ModalComponent
{
    use WithPagination;

    public Workout $workout;
    public WorkoutWeek $week;
    public WorkoutDay $day;
    public WorkoutSerie $serie;

    protected $listeners = [
        'add-exercise' => 'addExercise'
    ];

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

    public function addExercise($id, $repetitions)
    {
        $this->serie->items()->create([
            'workout_id' => $this->workout->id,
            'item_id' => $id,
            'item_type' => Exercise::class
        ]);
        $repetition = Repetition::create([
            'workout_id' => $this->workout->id,
            'workout_week_id' => $this->week->id,
            'quantity' => $repetitions
        ]);
        $this->serie->items()->create([
            'workout_id' => $this->workout->id,
            'item_id' => $repetition->id,
            'item_type' => Repetition::class
        ]);

        $this->emit('item-added', $id);
    }

    public function render()
    {
        $exercises = Exercise::paginate(10);
        return view('livewire.personal-trainer.workouts.modals.add-exercises', [
            'exercises' => $exercises
        ]);
    }
}
