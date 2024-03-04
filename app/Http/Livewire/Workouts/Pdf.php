<?php

namespace App\Http\Livewire\Workouts;

use App\Models\Workout;
use Livewire\Component;

class Pdf extends Component
{
    public $workout;
    public $workout_weeks;

    public function mount($workout, $workout_weeks = null)
    {
        $this->workout = Workout::find($workout);
        if ($this->workout->personal_trainer->id !== auth()->user()->id) {
            return abort(403);
        }
        if (!$workout_weeks) {
            $this->workout_weeks = $this->workout->workout_weeks()->whereHas('workout_days')->get();
        }

    }

    public function render()
    {
        return view('livewire.workouts.pdf')->layout('layouts.pdf');
    }
}
