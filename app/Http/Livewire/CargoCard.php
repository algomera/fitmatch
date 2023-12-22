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
            'quantity' => 0,
            'freestyle' => !$this->item->freestyle,
            'max' => false
        ]);
    }

    public function setMax()
    {
        $this->item->update([
            'quantity' => 0,
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

    public function render()
    {
        return view('livewire.cargo-card');
    }
}
