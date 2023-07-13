<?php

namespace App\Http\Livewire\PersonalTrainer;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.personal-trainer.dashboard', [
            'atletes' => auth()->user()->atletes
        ]);
    }
}
