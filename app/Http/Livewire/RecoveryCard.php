<?php

namespace App\Http\Livewire;

use App\Models\Recovery;
use App\Models\WorkoutSerie;
use Carbon\Carbon;
use Livewire\Component;

class RecoveryCard extends Component
{
    public $serie;
    public $item;

    public function mount(WorkoutSerie $serie, Recovery $item)
    {
        $this->serie = $serie;
        $this->item = $item;
    }

    public function increment()
    {
        $time = Carbon::parse($this->item->quantity)->addSeconds(10);
        $this->item->update(['quantity' => $time]);
    }

    public function decrement()
    {
        $time = Carbon::parse($this->item->quantity)->subSeconds(10);
        $this->item->update(['quantity' => $time]);
    }

    public function delete()
    {
        $this->serie->items()->where('item_id', $this->item->id)->where('item_type', Recovery::class)->delete();
        $this->item->delete();
        $this->emitTo('personal-trainer.workouts.show', 'item-deleted');
    }

    public function render()
    {
        return view('livewire.recovery-card');
    }
}
