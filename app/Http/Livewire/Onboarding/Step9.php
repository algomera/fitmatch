<?php

namespace App\Http\Livewire\Onboarding;

use Livewire\Component;

class Step9 extends Component
{
    public $image = 'https://images.unsplash.com/photo-1594381898411-846e7d193883?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=987&q=80';
    public $user_informations;

    protected $listeners = [
        'specialization-created' => '$refresh',
        'specialization-updated' => '$refresh',
        'specialization-deleted' => '$refresh'
    ];

    public function mount()
    {
        if (auth()->user()->onboarding_step_9) {
            return redirect()->route('onboarding.step-10');
        }
        $this->user_informations = auth()->user()->informations;
    }

    public function skip()
    {
        auth()->user()->update([
            'onboarding_step_9' => true
        ]);
        return redirect()->route('onboarding.step-10');
    }

    public function next()
    {
        auth()->user()->update([
            'onboarding_step_9' => true
        ]);
        return redirect()->route('onboarding.step-10');
    }

    public function render()
    {
        return view('livewire.onboarding.step9', [
            'specializations' => auth()->user()->specializations
        ])->layout('layouts.onboarding');
    }
}
