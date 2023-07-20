<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Workout extends Component
{
    public \App\Models\Workout $workout;

    public function render()
    {
        return view('livewire.components.workout');
    }
}
