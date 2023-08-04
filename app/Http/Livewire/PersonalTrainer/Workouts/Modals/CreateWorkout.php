<?php

namespace App\Http\Livewire\PersonalTrainer\Workouts\Modals;

use App\Models\Goal;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class CreateWorkout extends ModalComponent
{
    public $name, $workout_type = 'athlete', $duration = 1, $athlete_id = null, $start_date, $goal_id;
    protected $listeners = [
        'itemSelected'
    ];

    public function itemSelected($val)
    {
        $this->athlete_id = $val;
    }

    public function updatedWorkoutType($val)
    {
        if ($val === 'unassigned') {
            $this->athlete_id = null;
        }
    }

    public function save()
    {
        $this->validate();

        $workout = auth()->user()->personal_trainer_workouts()->create([
            'athlete_id' => $this->athlete_id ?? null,
            'name' => $this->name,
            'duration' => $this->duration,
            'start_date' => $this->start_date,
            'goal_id' => $this->goal_id
        ]);

        return redirect()->route('personal-trainer.workout', ['workout' => $workout->id]);
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
            'start_date' => 'required|date|after_or_equal:today',
            'goal_id' => 'required|exists:goals,id'
        ];
    }
}
