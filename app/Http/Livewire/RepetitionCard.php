<?php

namespace App\Http\Livewire;

use App\Models\Repetition;
use App\Models\WorkoutSerie;
use Livewire\Component;

class RepetitionCard extends Component
{
    public $serie;
    public $color = null;
    public $item;
    public $row;

    protected $rules = [
        'item.quantity' => 'numeric'
    ];

    public function mount(WorkoutSerie $serie, Repetition $item, $row, $color)
    {
        $this->serie = $serie;
        $this->color = $color;
        $this->item = $item;
        $this->row = $row;
    }

    public function updatedItemQuantity()
    {
        if ($this->item->quantity === '') {
            $this->item->quantity = 0;
        }

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

    public function duplicate()
    {
        $original = $this->serie->items()->find($this->row);
        $original_item = $original->item_type::find($original->item_id);
        $duplicated_item = $original_item->replicate();
        $duplicated_item->save();
        $duplicated = $original->replicate();
        $duplicated->item_id = $duplicated_item->id;
        $duplicated->save();
        $this->emit('item-added', $duplicated->item_id);
    }

    public function render()
    {
        return view('livewire.repetition-card');
    }
}
