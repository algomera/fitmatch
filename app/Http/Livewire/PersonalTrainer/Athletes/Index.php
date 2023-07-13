<?php

namespace App\Http\Livewire\PersonalTrainer\Athletes;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public User $selectedAthlete;

    public function mount() {
        $this->setAthlete(3);
    }

    public function setAthlete($id) {
        $this->selectedAthlete = User::find($id);
    }
    public function render()
    {
        return view('livewire.personal-trainer.athletes.index', [
            'athletes' => auth()->user()->athletes,
        ]);
    }
}
