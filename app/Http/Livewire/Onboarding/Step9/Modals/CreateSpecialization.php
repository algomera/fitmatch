<?php

namespace App\Http\Livewire\Onboarding\Step9\Modals;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class CreateSpecialization extends ModalComponent
{
    public $user;
    public $title, $school, $city, $start_date, $end_date, $description;
    protected $rules = [
        'title' => 'nullable',
        'school' => 'nullable',
        'city' => 'nullable',
        'start_date' => 'nullable|before:today',
        'end_date' => 'nullable|after:start_date',
        'description' => 'nullable',
    ];

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function mount($user = null)
    {
        if ($user) {
            $this->user = User::find($user);
        } else {
            $this->user = auth()->user();
        }
    }

    public function save()
    {
        $this->validate();

        $this->user->specializations()->create([
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
