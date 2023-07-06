<?php

namespace App\Http\Livewire\Onboarding;

use Livewire\Component;

class Step8 extends Component
{
    public $image = 'https://images.unsplash.com/photo-1594381898411-846e7d193883?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=987&q=80';
    public $user_informations;

    protected $listeners = [
        'job-experience-created' => '$refresh',
        'job-experience-updated' => '$refresh',
        'job-experience-deleted' => '$refresh'
    ];
    public function mount()
    {
        if(auth()->user()->onboarding_current_step !== 8) {
            return redirect()->route("onboarding.step-" . auth()->user()->onboarding_current_step);
        }
        $this->user_informations = auth()->user()->informations;
    }

    public function skip()
    {
        auth()->user()->increment('onboarding_current_step');
        return redirect()->route('onboarding.step-9');
    }

    public function next()
    {
        auth()->user()->increment('onboarding_current_step');
        return redirect()->route('onboarding.step-9');
    }

    public function render()
    {
        return view('livewire.onboarding.step8', [
            'job_experiences' => auth()->user()->job_experiences
        ])->layout('layouts.onboarding');
    }
}
