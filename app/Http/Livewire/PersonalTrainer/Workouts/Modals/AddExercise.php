<?php

namespace App\Http\Livewire\PersonalTrainer\Workouts\Modals;

use App\Models\Exercise;
use App\Models\WorkoutSerie;
use LivewireUI\Modal\ModalComponent;

class AddExercise extends ModalComponent
{
    public $workout;
    public $serie;
    public $selectedExercise;

    protected $listeners = [
        'itemSelected',
    ];

    public function mount(WorkoutSerie $serie)
    {
        $this->serie = $serie;
        $this->workout = $serie->workout;
    }

    public function itemSelected($val)
    {
        $this->selectedExercise = Exercise::find($val);
    }

    public function addExercise()
    {
        $this->serie->items()->create([
            'workout_id' => $this->workout->id,
            'item_id' => $this->selectedExercise->id,
            'item_type' => Exercise::class
        ]);
        $this->emit('item-added');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.personal-trainer.workouts.modals.add-exercise');
    }
}
