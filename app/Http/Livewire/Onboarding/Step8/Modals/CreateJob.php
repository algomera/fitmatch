<?php

    namespace App\Http\Livewire\Onboarding\Step8\Modals;

    use LivewireUI\Modal\ModalComponent;

    class CreateJob extends ModalComponent
    {
        public $title, $company, $city, $start_date, $end_date, $description;

        public static function modalMaxWidth(): string
        {
            return '4xl';
        }

        protected $rules = [
            'title' => 'nullable',
            'company' => 'nullable',
            'city' => 'nullable',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'description' => 'nullable',
        ];

        public function save()
        {
            $this->validate();

            auth()->user()->job_experiences()->create([
                'title' => $this->title,
                'company' => $this->company,
                'city' => $this->city,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'description' => $this->description
            ]);

            $this->emit('job-experience-created');
            $this->closeModal();
        }

        public function render()
        {
            return view('livewire.onboarding.step8.modals.create-job');
        }
    }
