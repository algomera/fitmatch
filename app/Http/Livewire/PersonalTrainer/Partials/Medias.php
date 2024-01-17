<?php

namespace App\Http\Livewire\PersonalTrainer\Partials;

use App\Models\User;
use Livewire\Component;

class Medias extends Component
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.personal-trainer.partials.medias', [
            'images' => $this->user->medias()->where('type', 'image')->get(),
            'videos' => $this->user->medias()->where('type', 'video')->get()
        ]);
    }
}
