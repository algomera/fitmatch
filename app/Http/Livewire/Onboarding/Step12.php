<?php

    namespace App\Http\Livewire\Onboarding;

    use Livewire\Component;

    class Step12 extends Component
    {
        public $image = 'https://images.unsplash.com/photo-1594381898411-846e7d193883?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=987&q=80';

        public function mount() {
            if(auth()->user()->status === 'approved') {
                return redirect()->route('personal-trainer.dashboard');
            } elseif(auth()->user()->onboarding_current_step !== 12) {
                return redirect()->route("onboarding.step-" . auth()->user()->onboarding_current_step);
            }
        }

        public function next()
        {
            if(auth()->user()->status === 'approved') {
                return redirect()->route('personal-trainer.dashboard');
            }
            if(auth()->user()->status === 'rejected') {
                dd("Account rifiutato, cosa fare?");
            }
            return redirect()->route('home');
        }

        public function render()
        {
            return view('livewire.onboarding.step12')->layout('layouts.onboarding');
        }
    }
