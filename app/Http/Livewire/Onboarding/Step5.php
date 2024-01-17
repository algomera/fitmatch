<?php

    namespace App\Http\Livewire\Onboarding;

    use Livewire\Component;

    class Step5 extends Component
    {
        public $image = 'https://images.unsplash.com/photo-1594381898411-846e7d193883?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=987&q=80';
        public $user_informations;

        protected $rules = [
            'user_informations.company_name' => 'required',
            'user_informations.company_address' => 'required',
            'user_informations.company_civic' => 'required',
            'user_informations.company_city' => 'required',
            'user_informations.company_zip_code' => 'required',
            'user_informations.company_vat_number' => 'required',
            'user_informations.company_fiscal_code' => 'nullable',
        ];

        public function mount()
        {
            if(auth()->user()->onboarding_current_step !== 5) {
                return redirect()->route("onboarding.step-" . auth()->user()->onboarding_current_step);
            }
            $this->user_informations = auth()->user()->informations;
        }

        public function next()
        {
            $this->validate();
            auth()->user()->informations()->update([
                'company_name' => $this->user_informations->company_name,
                'company_address' => $this->user_informations->company_address,
                'company_civic' => $this->user_informations->company_civic,
                'company_city' => $this->user_informations->company_city,
                'company_zip_code' => $this->user_informations->company_zip_code,
                'company_vat_number' => $this->user_informations->company_vat_number,
                'company_fiscal_code' => $this->user_informations->company_fiscal_code,
            ]);
            auth()->user()->increment('onboarding_current_step');
            return redirect()->route('onboarding.step-6');
        }

        public function render()
        {
            return view('livewire.onboarding.step5')->layout('layouts.onboarding');
        }
    }
