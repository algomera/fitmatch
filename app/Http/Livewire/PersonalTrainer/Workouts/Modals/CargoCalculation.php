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
        return 'md';
    }

    public function mount(WorkoutSerie $serie, Cargo $item)
    {
        $this->serie = $serie;
        $this->item = $item;
        $this->massimale = $item->massimale;
        $this->percentuale = $item->percentuale;
        $this->effettivo = $item->effettivo;
    }

    public function updated($field)
    {
        if ($this->$field === '') {
            $this->$field = 0;
        }
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

    public function calculateMassimale()
    {
        $this->massimale = round(($this->percentuale * 100) / $this->effettivo, 2);
    }

    public function calculatePercentuale()
    {
        $this->percentuale = round($this->massimale * $this->effettivo, 2);
    }

    public function calculateEffettivo()
    {
        $this->effettivo = round(($this->percentuale * 100) / $this->massimale, 2);
    }

    public function resetAll()
    {
        $this->reset('massimale', 'percentuale', 'effettivo');
    }


    public function save()
    {
        $this->item->update([
            'quantity' => $this->effettivo,
            'massimale' => $this->massimale,
            'percentuale' => $this->percentuale,
            'effettivo' => $this->effettivo
        ]);
        $this->emit('cargo-calculated');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.personal-trainer.workouts.modals.cargo-calculation');
    }
}
