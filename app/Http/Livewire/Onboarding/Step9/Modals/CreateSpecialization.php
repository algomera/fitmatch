<?php

    namespace App\Http\Livewire\Onboarding\Step9\Modals;

    use LivewireUI\Modal\ModalComponent;

    class CreateSpecialization extends ModalComponent
    {
        public $title, $school, $city, $start_date, $end_date, $description;

        public static function modalMaxWidth(): string
        {
            return '4xl';
        }

        protected $rules = [
            'title' => 'nullable',
            'school' => 'nullable',
            'city' => 'nullable',
            'start_date' => 'nullable|before:today',
            'end_date' => 'nullable|after:start_date',
            'description' => 'nullable',
        ];

        public function save()
        {
            $this->validate();

            auth()->user()->specializations()->create([
                'title' => $this->title,
                'school' => $this->school,
                'city' => $this->city,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'description' => $this->description
            ]);

            $this->emit('specialization-created');
            $this->closeModal();
        }

        public function render()
        {
            return view('livewire.onboarding.step9.modals.create-specialization');
        }
    }
