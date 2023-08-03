<?php

namespace App\Http\Livewire\PersonalTrainer\Workouts\Modals;

use App\Models\Cargo;
use App\Models\WorkoutSerie;
use LivewireUI\Modal\ModalComponent;

class CargoCalculation extends ModalComponent
{
    public $serie;
    public $item;
    public $massimale = 0;
    public $percentuale = 0;
    public $effettivo = 0;

    public static function modalMaxWidth(): string
    {
        return 'sm';
    }

    public function mount(WorkoutSerie $serie, Cargo $item)
    {
        $this->serie = $serie;
        $this->item = $item;
    }

    public function increment($what)
    {
        $this->$what++;
    }

    public function decrement($what)
    {
        if ($this->$what <= 0) {
            return;
        }
        $this->$what--;
    }


    public function save()
    {
        $carico = $this->massimale * $this->percentuale / 100;
        $this->item->update([
            'quantity' => $carico
        ]);
        $this->emit('cargo-calculated');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.personal-trainer.workouts.modals.cargo-calculation');
    }
}
