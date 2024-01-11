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
    protected $rules = [
        'massimale' => 'numeric',
        'percentuale' => 'numeric',
        'effettivo' => 'numeric',
    ];

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
        $this->validateOnly($field);

        $this->updateValues($field);
    }

    private function updateValues($changedField)
    {
        switch ($changedField) {
            case 'massimale':
                $this->calculateEffettivo();
                $this->calculatePercentuale();
                break;
            case 'percentuale':
                $this->calculateEffettivo();
                $this->calculateMassimale();
                break;
            case 'effettivo':
                $this->calculateMassimale();
                $this->calculatePercentuale();
                break;
        }
    }

    private function calculateEffettivo()
    {
        if ($this->percentuale > 0 && $this->massimale > 0) {
            $this->reset("effettivo");
            $this->effettivo = round(($this->percentuale * 100) / $this->massimale, 2);
        }
    }

    private function calculatePercentuale()
    {
        if ($this->massimale > 0 && $this->effettivo > 0) {
            $this->reset("percentuale");
            $this->percentuale = round($this->massimale * $this->effettivo, 2); //todo mmh
        }
    }

    private function calculateMassimale()
    {
        if ($this->percentuale > 0 && $this->effettivo > 0) {
            $this->reset("massimale");
            $this->massimale = round(($this->percentuale * 100) / $this->effettivo, 2);
        }
    }

    public function increment($what)
    {
        $this->$what++;
        switch ($what) {
            case 'massimale':
                $this->calculateEffettivo();
                $this->calculatePercentuale();
                break;
            case 'percentuale':
                $this->calculateEffettivo();
                $this->calculateMassimale();
                break;
            case 'effettivo':
                $this->calculateMassimale();
                $this->calculatePercentuale();
                break;
        }
    }

    public function decrement($what)
    {
        if ($this->$what <= 0) {
            return;
        }
        $this->$what--;
        switch ($what) {
            case 'massimale':
                $this->calculateEffettivo();
                $this->calculatePercentuale();
                break;
            case 'percentuale':
                $this->calculateEffettivo();
                $this->calculateMassimale();
                break;
            case 'effettivo':
                $this->calculateMassimale();
                $this->calculatePercentuale();
                break;
        }
    }


    public function save()
    {
        $carico = $this->massimale * $this->percentuale / 100;
        $this->item->update([
            'quantity' => $carico,
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
