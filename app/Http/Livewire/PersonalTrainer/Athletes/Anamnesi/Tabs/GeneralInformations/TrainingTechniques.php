<?php

namespace App\Http\Livewire\PersonalTrainer\Athletes\Anamnesi\Tabs\GeneralInformations;

use App\Models\User;
use Livewire\Component;

class TrainingTechniques extends Component
{
    public User $athlete;

    public function render()
    {
        return view('livewire.personal-trainer.athletes.anamnesi.tabs.general-informations.training-techniques');
    }
}
