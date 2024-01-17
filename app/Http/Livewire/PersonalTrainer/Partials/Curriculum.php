<?php

namespace App\Http\Livewire\PersonalTrainer\Partials;

use App\Models\User;
use Livewire\Component;

class Curriculum extends Component
{

    public $user;

    protected $listeners = [
        'job-experience-created' => '$refresh',
        'job-experience-updated' => '$refresh',
        'specialization-created' => '$refresh',
        'specialization-updated' => '$refresh'
    ];

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.personal-trainer.partials.curriculum', [
            'job_experiences' => $this->user->job_experiences,
            'specializations' => $this->user->specializations
        ]);
    }
}
