<?php

namespace App\Http\Livewire;

use App\Models\Exercise;
use App\Models\WorkoutSerie;
use Livewire\Component;

class ExerciseCard extends Component
{
    public $serie;
    public $item;

    public function mount(WorkoutSerie $serie, Exercise $item)
    {
        $this->serie = $serie;
        $this->item = $item;
    }

    public function delete()
    {
        $this->serie->items()->where('item_id', $this->item->id)->where('item_type', Exercise::class)->delete();
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
