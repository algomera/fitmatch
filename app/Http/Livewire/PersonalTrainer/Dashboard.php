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
            'assigned_workouts' => auth()->user()->personal_trainer_workouts()->assigned()->take(4)->get(),
            'not_assigned_workouts' => auth()->user()->personal_trainer_workouts()->notAssigned()->take(4)->get(),
            'exercises' => Exercise::all()
        ]);
    }
}
