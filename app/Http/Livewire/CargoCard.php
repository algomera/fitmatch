<?php

namespace App\Http\Livewire;

use App\Models\Cargo;
use App\Models\WorkoutSerie;
use Livewire\Component;

class CargoCard extends Component
{
    public $serie;
    public $color = null;
    public $item;
    public $row;

    protected $listeners = [
        'cargo-calculated' => '$refresh'
    ];

    public function mount(WorkoutSerie $serie, Cargo $item, $row, $color)
    {
        $this->serie = $serie;
        $this->color = $color;
        $this->item = $item;
        $this->row = $row;
    }

    public function setFreestyle()
    {
        $this->item->update([
            'quantity' => $this->item->quantity ?? 0,
            'freestyle' => !$this->item->freestyle,
            'max' => false
        ]);
    }

    public function setMax()
    {
        $this->item->update([
            'quantity' => $this->item->quantity ?? 0,
            'freestyle' => false,
            'max' => !$this->item->max
        ]);
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
        return view('livewire.cargo-card');
    }
}
