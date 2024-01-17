<?php

namespace App\Http\Livewire;

use App\Models\Recovery;
use App\Models\WorkoutSerie;
use Carbon\Carbon;
use Livewire\Component;

class RecoveryCard extends Component
{
    public $serie;
    public $color = null;
    public $item;
    public $row;

    public function mount(WorkoutSerie $serie, Recovery $item, $row, $color)
    {
        $this->serie = $serie;
        $this->color = $color;
        $this->item = $item;
        $this->row = $row;
    }

    public function increment($value)
    {
        $time = Carbon::parse($this->item->quantity)->addSeconds($value);
        $this->item->update(['quantity' => $time]);
    }

    public function decrement($value)
    {
        if ($this->item->quantity->format('i:s') <= '00:00') {
            return;
        }
        $time = Carbon::parse($this->item->quantity)->subSeconds($value);
        $this->item->update(['quantity' => $time]);
    }

    public function delete()
    {
        $this->serie->items()->find($this->row)->delete();
        $this->item->delete();
        $this->emitTo('personal-trainer.workouts.show', 'item-deleted');
    }

    public function render()
    {
        return view('livewire.recovery-card');
    }
}
