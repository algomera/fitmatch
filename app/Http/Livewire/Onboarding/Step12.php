<?php

    namespace App\Http\Livewire\Onboarding;

    use Livewire\Component;

    class Step12 extends Component
    {
        public $image = 'https://images.unsplash.com/photo-1594381898411-846e7d193883?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=987&q=80';

        public function mount() {
            if(auth()->user()->accepted === 1) {
                return redirect()->route('dashboard');
            }
        }

        public function next()
        {
            if(auth()->user()->accepted) {
                return redirect()->route('dashboard');
            }
            return redirect()->route('home');
        }

        public function render()
        {
            return view('livewire.onboarding.step12')->layout('layouts.onboarding');
        }
    }
