<?php

namespace App\Http\Livewire;

use App\Models\Repetition;
use App\Models\WorkoutSerie;
use Livewire\Component;

class RepetitionCard extends Component
{
    public $serie;
    public $item;

    public function mount(WorkoutSerie $serie, Repetition $item)
    {
        $this->serie = $serie;
        $this->item = $item;
    }

    public function increment()
    {
        $this->item->increment('quantity', 1);
    }

    public function decrement()
    {
        if ($this->item->quantity <= 0) {
            return;
        }
        $this->item->decrement('quantity', 1);
    }

    public function delete()
    {
        $this->serie->items()->where('item_id', $this->item->id)->where('item_type', Repetition::class)->delete();
        $this->item->delete();
        $this->emitTo('personal-trainer.workouts.show', 'item-deleted');
    }

    public function render()
    {
        return view('livewire.repetition-card');
    }
}
