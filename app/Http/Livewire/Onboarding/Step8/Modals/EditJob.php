<?php

    namespace App\Http\Livewire\Onboarding\Step8\Modals;

    use App\Models\JobExperience;
    use LivewireUI\Modal\ModalComponent;

    class EditJob extends ModalComponent
    {
        public $job;

        public static function modalMaxWidth(): string
        {
            return '4xl';
        }

        protected $rules = [
            'job.title' => 'nullable',
            'job.company' => 'nullable',
            'job.city' => 'nullable',
            'job.start_date' => 'nullable|before:today',
            'job.end_date' => 'nullable|after:start_date',
            'job.description' => 'nullable',
        ];

        public function mount(JobExperience $job) {
            $this->job = $job;
        }

        public function save()
        {
            $this->validate();

            $this->job->update([
                'title' => $this->job->title,
                'company' => $this->job->company,
                'city' => $this->job->city,
                'start_date' => $this->job->start_date,
                'end_date' => $this->job->end_date,
                'description' => $this->job->description
            ]);

//            auth()->user()->job_experiences()->create([
//                'title' => $this->title,
//                'company' => $this->company,
//                'city' => $this->city,
//                'start_date' => $this->start_date,
//                'end_date' => $this->end_date,
//                'description' => $this->description
//            ]);

            $this->emit('job-experience-updated');
            $this->closeModal();
        }

        public function render()
        {
            return view('livewire.onboarding.step8.modals.edit-job');
        }
    }
