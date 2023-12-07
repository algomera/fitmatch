<?php

namespace App\Http\Livewire;

use App\Models\Exercise;
use App\Models\WorkoutSerie;
use Livewire\Component;

class ExerciseCard extends Component
{
    public $serie;
    public $item;
    public $row;

    public function mount(WorkoutSerie $serie, Exercise $item, $row)
    {
        $this->serie = $serie;
        $this->item = $item;
        $this->row = $row;
    }

    public function delete()
    {
        $this->serie->items()->find($this->row)->delete();
        $this->emitTo('personal-trainer.workouts.show', 'item-deleted');
        $this->dispatchBrowserEvent('open-notification', [
            'title' => __('Esercizio Eliminato'),
            'type' => 'success',
        ]);
    }

    public function render()
    {
        return view('livewire.exercise-card');
    }
}
