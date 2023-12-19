<?php

namespace App\Http\Livewire;

use App\Models\Repetition;
use App\Models\WorkoutSerie;
use Livewire\Component;

class RepetitionCard extends Component
{
    public $serie;
    public $item;
    public $row;

    protected $rules = [
        'item.quantity' => 'numeric'
    ];

    public function mount(WorkoutSerie $serie, Repetition $item, $row)
    {
        $this->serie = $serie;
        $this->item = $item;
        $this->row = $row;
    }

    public function updatedItemQuantity()
    {
        $this->item->update([
            'quantity' => $this->item->quantity
        ]);
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
        $this->serie->items()->find($this->row)->delete();
        $this->item->delete();
        $this->emitTo('personal-trainer.workouts.show', 'item-deleted');
    }

    public function render()
    {
        return view('livewire.repetition-card');
    }
}
