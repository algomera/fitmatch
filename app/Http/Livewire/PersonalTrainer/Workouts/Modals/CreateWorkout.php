<?php

namespace App\Http\Livewire\PersonalTrainer\Workouts\Modals;

use App\Http\Livewire\PersonalTrainer\Exercises\Modals\AddExerciseToExistingWorkout;
use App\Models\Goal;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class CreateWorkout extends ModalComponent
{
    public $name, $workout_type = 'athlete', $duration = 1, $athlete_id = null, $start_date, $goal_id;
    public $from_exercises_modal = false;
    protected $listeners = [
        'itemSelected'
    ];

    public static function destroyOnClose(): bool
    {
        return true;
    }

    public function itemSelected($val)
    {
        $this->athlete_id = $val;
    }

    public function updatedWorkoutType($val)
    {
        if ($val === 'unassigned') {
            $this->athlete_id = null;
            $this->start_date = null;
        }
    }

    public function save()
    {
        $this->validate();

        $workout = auth()->user()->personal_trainer_workouts()->create([
            'athlete_id' => $this->athlete_id ?? null,
            'name' => $this->name,
            'duration' => $this->duration,
            'start_date' => $this->start_date ?? null,
            'goal_id' => $this->goal_id
        ]);
        foreach (range(1, $workout->duration) as $week) {
            $workout->workout_weeks()->create([
                'week' => $week
            ]);
        }

        if (!$this->from_exercises_modal) {
            return redirect()->route('personal-trainer.workout', ['workout' => $workout->id]);
        } else {
            $this->closeModalWithEvents([
                AddExerciseToExistingWorkout::getName() => ['workoutCreated', [$workout->id]],
            ]);
        }
    }

    public function render()
    {
        return view('livewire.personal-trainer.workouts.modals.create-workout', [
            'goals' => Goal::all()
        ]);
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'workout_type' => 'required|in:athlete,unassigned',
            'duration' => 'required|between:1,10',
            'athlete_id' => [
                $this->workout_type === 'athlete' ? 'required' : 'nullable',
                $this->workout_type === 'athlete' ?
                    Rule::exists('personal_trainer_athlete')->where(function (Builder $query) {
                        return $query->where('personal_trainer_id', auth()->user()->id);
                    }) : 'nullable'
            ],
            'start_date' => [
                $this->workout_type === 'athlete' ? ['required', 'date', 'after_or_equal:today'] : 'nullable'
            ],
            'goal_id' => 'required|exists:goals,id'
        ];
    }
}
