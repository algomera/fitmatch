<?php

namespace App\Http\Livewire\PersonalTrainer\Workouts\Modals;

use App\Models\WorkoutSerieItem;
use LivewireUI\Modal\ModalComponent;

class ExerciseNotes extends ModalComponent
{
    public WorkoutSerieItem $item;
    public $notes = '';

    public function mount(WorkoutSerieItem $item)
    {
        $this->item = $item;
        $this->notes = $item->notes;
    }

    public function save()
    {
        $this->item->update([
            'notes' => $this->notes
        ]);

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.personal-trainer.workouts.modals.exercise-notes');
    }
}
