<?php

namespace App\Http\Livewire\PersonalTrainer\Workouts\Modals;

use App\Models\WorkoutWeek;
use LivewireUI\Modal\ModalComponent;

class PasteWeek extends ModalComponent
{
    public $from, $to;

    public function mount(WorkoutWeek $from, WorkoutWeek $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function paste()
    {
        $this->emit('pasteWeek');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.personal-trainer.workouts.modals.paste-week');
    }
}
