<?php

namespace App\Http\Livewire\PersonalTrainer\Workouts;

use App\Models\User;
use App\Models\Workout;
use Livewire\Component;

class Index extends Component
{
    public $filter =3;
    public $athlete;

    public function render()
    {
        $workouts = auth()->user()->personal_trainer_workouts();

        if($this->filter === 'unassigned') {
            $workouts->where('athlete_id', null);
        } else {
            $this->athlete = User::find($this->filter);
            $workouts->where('athlete_id', $this->filter);
        }

        return view('livewire.personal-trainer.workouts.index', [
            'workouts' => $workouts->get(),
            'athletes' => auth()->user()->athletes,
        ]);
    }
}
