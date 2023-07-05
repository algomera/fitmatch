<?php

    namespace App\Http\Livewire\Onboarding\Step9\Modals;

    use App\Models\Specializations;
    use LivewireUI\Modal\ModalComponent;

    class DeleteSpecialization extends ModalComponent
    {
        public $specialization;
        public static function modalMaxWidth(): string
        {
            return '2xl';
        }

        public function mount(Specializations $specialization) {
            $this->specialization = $specialization;
        }

        public function delete()
        {
            $this->specialization->delete();
            $this->emit('specialization-deleted');
            $this->closeModal();
        }

        public function render()
        {
            return view('livewire.onboarding.step9.modals.delete-specialization');
        }
    }
