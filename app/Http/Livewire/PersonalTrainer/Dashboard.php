<?php

namespace App\Http\Livewire\PersonalTrainer;

use App\Models\Exercise;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.personal-trainer.dashboard', [
            'athletes' => auth()->user()->athletes,
            'workouts' => auth()->user()->personal_trainer_workouts,
            'exercises' => Exercise::all()
        ]);
    }
}
