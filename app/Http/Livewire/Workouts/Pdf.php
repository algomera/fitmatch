<?php

namespace App\Http\Livewire\Workouts;

use App\Models\Workout;
use Livewire\Component;

class Pdf extends Component
{
    public Workout $workout;

    public function mount()
    {
        if ($this->workout->personal_trainer->id !== auth()->user()->id) {
            return abort(403);
        }
    }

    public function render()
    {
        return view('livewire.workouts.pdf')->layout('layouts.pdf');
    }
}
