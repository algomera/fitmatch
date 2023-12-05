<?php

namespace App\Http\Livewire\PersonalTrainer\Athletes\Anamnesi\Tabs;

use App\Models\User;
use Livewire\Component;

class AnthropometricMeasurements extends Component
{
    public User $athlete;

    public function render()
    {
        return view('livewire.personal-trainer.athletes.anamnesi.tabs.anthropometric-measurements');
    }
}
