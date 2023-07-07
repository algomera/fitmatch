<?php

namespace App\Http\Livewire\PersonalTrainer;

use App\Models\User;
use Livewire\Component;

class Show extends Component
{
    public User $user;
    public $tabs = [
        'informations' => 'Informazioni',
        'curriculum' => 'Curriculum e specializzazioni',
        'medias' => 'Immagini e video'
    ];
    public $currentTab = 'informations';

    public function changeStatus($status) {
        $this->user->update([
            'status' => $status
        ]);
        $this->emitSelf('$refresh');
    }

    public function render()
    {
        return view('livewire.personal-trainer.show');
    }
}
