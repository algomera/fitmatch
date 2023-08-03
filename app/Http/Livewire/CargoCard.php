<?php

namespace App\Http\Livewire;

use App\Models\Cargo;
use App\Models\WorkoutSerie;
use Livewire\Component;

class CargoCard extends Component
{
    public $serie;
    public $item;

    protected $listeners = [
        'cargo-calculated' => '$refresh'
    ];

    public function mount(WorkoutSerie $serie, Cargo $item)
    {
        $this->serie = $serie;
        $this->item = $item;
    }

    public function delete()
    {
        $this->serie->items()->where('item_id', $this->item->id)->where('item_type', Cargo::class)->delete();
        $this->item->delete();
        $this->emitTo('personal-trainer.workouts.show', 'item-deleted');
    }

    public function render()
    {
        return view('livewire.cargo-card');
    }
}
