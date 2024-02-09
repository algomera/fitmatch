<?php

namespace App\Http\Livewire;

use App\Models\Exercise;
use App\Models\WorkoutSerie;
use App\Models\WorkoutSerieItem;
use Livewire\Component;

class ExerciseCard extends Component
{
    public $serie;
    public $color = null;
    public $item;
    public $row;
    public $intensity = null;

    public function mount(WorkoutSerie $serie, Exercise $item, $row, $color)
    {
        $this->serie = $serie;
        $this->color = $color;
        $this->item = $item;
        $this->row = $row;
        $this->intensity = WorkoutSerieItem::find($row)->intensity?->name;
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

    public function duplicate()
    {
        $original = $this->serie->items()->find($this->row);
        $duplicated = $original->replicate();
        $duplicated->save();
        $this->emit('item-added', $duplicated->item_id);
    }

    public function render()
    {
        return view('livewire.exercise-card');
    }
}
