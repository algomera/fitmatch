<?php

namespace App\Http\Livewire\PersonalTrainer\Athletes\Anamnesi\Tabs\Physiology;

use App\Models\User;
use Livewire\Component;

class Diet extends Component
{
    public User $athlete;

    public function render()
    {
        return view('livewire.personal-trainer.athletes.anamnesi.tabs.physiology.diet');
    }
}
