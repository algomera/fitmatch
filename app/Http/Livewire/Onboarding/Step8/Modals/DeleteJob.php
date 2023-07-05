<?php

    namespace App\Http\Livewire\Onboarding\Step8\Modals;

    use App\Models\JobExperience;
    use LivewireUI\Modal\ModalComponent;

    class DeleteJob extends ModalComponent
    {
        public $job;
        public static function modalMaxWidth(): string
        {
            return '2xl';
        }

        public function mount(JobExperience $job) {
            $this->job = $job;
        }

        public function delete()
        {
            $this->job->delete();
            $this->emit('job-experience-deleted');
            $this->closeModal();
        }

        public function render()
        {
            return view('livewire.onboarding.step8.modals.delete-job');
        }
    }
