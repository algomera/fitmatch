<?php

namespace App\Http\Livewire\PersonalTrainer\Exercises;

use App\Models\Exercise;
use Livewire\Component;

class ExerciseItem extends Component
{
    public $exercise;
    public $repetitions = 0;

    protected $listeners = [
        'item-added' => 'itemAdded'
    ];

    public function mount(Exercise $exercise)
    {
        $this->exercise = $exercise;
    }

    public function increment()
    {
        $this->repetitions++;
    }

    public function decrement()
    {
        if ($this->repetitions <= 0) {
            return;
        }
        $this->repetitions--;
    }

    public function itemAdded($id)
    {
        $this->repetitions = 0;
        $this->dispatchBrowserEvent('open-notification', [
            'title' => __('Esercizio assegnato'),
            'subtitle' => __('L\'esercizio e le ripetizioni sono state assegnate correttamente.'),
            'type' => 'success',
        ]);
    }

    public function addFavorite()
    {
        auth()->user()->favorites()->attach($this->exercise->id);

    }

    public function removeFavorite()
    {
        auth()->user()->favorites()->detach($this->exercise->id);

    }

    public function render()
    {
        return view('livewire.personal-trainer.exercises.exercise-item');
    }
}
