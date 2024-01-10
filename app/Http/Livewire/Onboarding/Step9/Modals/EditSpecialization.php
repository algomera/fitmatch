<?php

namespace App\Http\Livewire\Onboarding\Step9\Modals;

use App\Models\Specialization;
use LivewireUI\Modal\ModalComponent;

class EditSpecialization extends ModalComponent
{
    public $specialization;
    protected $rules = [
        'specialization.title' => 'nullable',
        'specialization.school' => 'nullable',
        'specialization.city' => 'nullable',
        'specialization.start_date' => 'nullable|before:today',
        'specialization.end_date' => 'nullable|after:start_date',
        'specialization.description' => 'nullable',
    ];

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function mount(Specialization $specialization)
    {
        $this->specialization = $specialization;
    }

    public function save()
    {
        $this->validate();

        $this->specialization->update([
            'title' => $this->specialization->title,
            'school' => $this->specialization->school,
            'city' => $this->specialization->city,
            'start_date' => $this->specialization->start_date,
            'end_date' => $this->specialization->end_date,
            'description' => $this->specialization->description
        ]);

        $this->emit('specialization-updated');
        $this->closeModal();
    }

    public function delete()
    {
        $this->specialization->delete();
        $this->emit('specialization-updated');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.onboarding.step9.modals.edit-specialization');
    }
}
