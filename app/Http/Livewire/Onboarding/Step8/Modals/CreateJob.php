<?php

    namespace App\Http\Livewire\Onboarding\Step8\Modals;

    use App\Models\User;
    use LivewireUI\Modal\ModalComponent;

    class CreateJob extends ModalComponent
    {
        public $user;
        public $title, $company, $city, $start_date, $end_date, $description;

        public static function modalMaxWidth(): string
        {
            return '4xl';
        }

        public function mount(User $user = null) {
            if($user) {
                $this->user = $user;
            } else {
                $this->user = auth()->user();
            }
        }

        protected $rules = [
            'title' => 'nullable',
            'company' => 'nullable',
            'city' => 'nullable',
            'start_date' => 'nullable|before:today',
            'end_date' => 'nullable|after:start_date',
            'description' => 'nullable',
        ];

        public function save()
        {
            $this->validate();

            $this->user->job_experiences()->create([
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
