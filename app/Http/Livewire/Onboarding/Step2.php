<?php

    namespace App\Http\Livewire\Onboarding;

    use Livewire\Component;

    class Step2 extends Component
    {
        public $image = 'https://images.unsplash.com/photo-1594381898411-846e7d193883?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=987&q=80';
        public $user_informations;

        protected $rules = [
            'user_informations.profile_type' => 'required',
        ];

        public function mount() {
            if(auth()->user()->onboarding_step_2) {
                return redirect()->route('onboarding.step-3');
            }
            $this->user_informations = auth()->user()->informations;
        }

        public function next()
        {
            $this->validate();
            auth()->user()->informations()->update([
                'profile_type' => $this->user_informations->profile_type
            ]);
            auth()->user()->update([
                'onboarding_step_2' => true
            ]);
            return redirect()->route('onboarding.step-3');
        }

        public function render()
        {
            return view('livewire.onboarding.step2')->layout('layouts.onboarding');
        }
    }
