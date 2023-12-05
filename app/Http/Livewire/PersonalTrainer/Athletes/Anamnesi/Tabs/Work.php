<?php

namespace App\Http\Livewire\PersonalTrainer\Athletes\Anamnesi\Tabs;

use App\Models\User;
use Livewire\Component;

class Work extends Component
{
    public User $athlete;

    public function render()
    {
        return view('livewire.personal-trainer.athletes.anamnesi.tabs.work');
    }
}
