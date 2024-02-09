<?php

namespace App\Http\Livewire\Onboarding;

use Livewire\Component;

class Subscribe extends Component
{
    public function mount()
    {
        if (auth()->user()->role->name === 'personal-trainer' && auth()->user()->subscribed()) {
            return redirect()->route('personal-trainer.dashboard');
        }
    }

    public function checkout($plan)
    {
        return auth()->user()
            ->newSubscription('default', $plan)
            ->checkout([
                'success_url' => route('subscription-ok'),
                'cancel_url' => route('subscribe'),
            ]);
    }

    public function render()
    {
        return view('livewire.onboarding.subscribe')->layout('layouts.blank');
    }
}
