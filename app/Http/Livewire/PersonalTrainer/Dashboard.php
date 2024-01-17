<?php

namespace App\Http\Livewire\PersonalTrainer;

use App\Models\Exercise;
use Livewire\Component;

class Dashboard extends Component
{
    protected $listeners = [
        'workout-deleted' => '$refresh',
        'workout-duplicated' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.personal-trainer.dashboard', [
            'workouts_count' => auth()->user()->personal_trainer_workouts->count(),
            'athletes' => auth()->user()->athletes,
            'assigned_workouts' => auth()->user()->personal_trainer_workouts()->assigned()->take(4)->get(),
            'not_assigned_workouts' => auth()->user()->personal_trainer_workouts()->notAssigned()->take(4)->get(),
            'exercises' => Exercise::all()
        ]);
    }
}
