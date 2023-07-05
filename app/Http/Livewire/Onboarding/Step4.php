<?php

    namespace App\Http\Livewire\Onboarding;

    use Livewire\Component;

    class Step4 extends Component
    {
        public $image = 'https://images.unsplash.com/photo-1594381898411-846e7d193883?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=987&q=80';
        public $user_informations;

        protected $rules = [
            'user_informations.first_name' => 'required',
            'user_informations.last_name' => 'required',
            'user_informations.dob' => 'required|date|before:today',
            'user_informations.phone' => 'required',
            'user_informations.city' => 'required',
        ];

        public function mount()
        {
            if(auth()->user()->onboarding_step_4) {
                return redirect()->route('onboarding.step-5');
            }
            $this->user_informations = auth()->user()->informations;
        }

        public function next()
        {
            $this->validate();
            auth()->user()->informations()->update([
                'first_name' => $this->user_informations->first_name,
                'last_name' => $this->user_informations->last_name,
                'dob' => $this->user_informations->dob,
                'phone' => $this->user_informations->phone,
                'city' => $this->user_informations->city,
            ]);
            auth()->user()->update([
                'onboarding_step_4' => true
            ]);
            return redirect()->route('onboarding.step-5');
        }

        public function render()
        {
            return view('livewire.onboarding.step4')->layout('layouts.onboarding');
        }
    }
