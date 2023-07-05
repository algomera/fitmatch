<?php

    namespace App\Http\Livewire\Onboarding;

    use Livewire\Component;

    class Step3 extends Component
    {
        public $image = 'https://images.unsplash.com/photo-1594381898411-846e7d193883?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=987&q=80';
        public $user_informations, $disabled;

        protected $rules = [
            'user_informations.remote' => 'required',
            'user_informations.in_person' => 'required',
        ];

        public function mount() {
            if(auth()->user()->onboarding_step_3) {
                return redirect()->route('onboarding.step-4');
            }
            $this->user_informations = auth()->user()->informations;
            $this->updatedUserInformations();
        }

        public function updatedUserInformations() {
            $this->disabled = $this->user_informations->remote || $this->user_informations->in_person;
        }

        public function next()
        {
            $this->validate();
            auth()->user()->informations()->update([
                'remote' => $this->user_informations->remote,
                'in_person' => $this->user_informations->in_person
            ]);
            auth()->user()->update([
                'onboarding_step_3' => true
            ]);
            return redirect()->route('onboarding.step-4');
        }

        public function render()
        {
            return view('livewire.onboarding.step3')->layout('layouts.onboarding');
        }
    }
