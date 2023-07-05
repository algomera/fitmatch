<?php

    namespace App\Http\Livewire\Onboarding;

    use Livewire\Component;

    class Step7 extends Component
    {
        public $image = 'https://images.unsplash.com/photo-1594381898411-846e7d193883?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=987&q=80';
        public $user_informations;

        protected $rules = [
            'user_informations.instagram' => 'nullable',
            'user_informations.facebook' => 'nullable',
            'user_informations.website' => 'nullable',
        ];

        public function mount()
        {
            if(auth()->user()->onboarding_step_7) {
                return redirect()->route('onboarding.step-8');
            }
            $this->user_informations = auth()->user()->informations;
        }

        public function next()
        {
            $this->validate();
            auth()->user()->informations()->update([
                'instagram' => $this->user_informations->instagram,
                'facebook' => $this->user_informations->facebook,
                'website' => $this->user_informations->website,
            ]);
            auth()->user()->update([
                'onboarding_step_7' => true
            ]);
            return redirect()->route('onboarding.step-8');
        }

        public function render()
        {
            return view('livewire.onboarding.step7')->layout('layouts.onboarding');
        }
    }
