<?php

namespace App\Http\Livewire\PersonalTrainer\Workouts;

use App\Models\Workout;
use Livewire\Component;

class Show extends Component
{
    public $workout;
    public $athlete;

    public function mount(Workout $workout) {
        $this->workout = $workout;
        $this->athlete = $workout->athlete;
    }
    public function render()
    {
        return view('livewire.personal-trainer.workouts.show');
    }
}
