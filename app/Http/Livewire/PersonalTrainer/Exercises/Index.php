<?php

namespace App\Http\Livewire\PersonalTrainer\Exercises;

use App\Models\Exercise;
use App\Models\ExerciseArea;
use App\Models\ExerciseTypology;
use App\Models\ExerciseZone;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $area;
    public $typology;
    public $zone;
    public $favorites = false;

    protected $listeners = [
        'add-exercise' => 'addExercise',
        'toggleFavorite' => '$refresh',
    ];

    public function updatingArea()
    {
        $this->resetPage();
    }

    public function updatingTypology()
    {
        $this->resetPage();
    }

    public function updatingZone()
    {
        $this->resetPage();
    }

    public function addExercise($id, $repetitions)
    {
        $this->emit('openModal', 'personal-trainer.exercises.modals.add-exercise-to-existing-workout', [
            'exercise' => $id,
            'repetitions' => $repetitions
        ]);
    }

    public function resetFilters()
    {
        $this->area = null;
        $this->typology = null;
        $this->zone = null;
    }

    public function render()
    {
        $exercises = Exercise::query();
        $areas = ExerciseArea::all();
        $typologies = ExerciseTypology::all();
        $zones = ExerciseZone::all();

        if ($this->area) {
            $exercises->where('area_id', $this->area);
        }
        if ($this->typology) {
            $exercises->where('typology_id', $this->typology);
        }
        if ($this->zone) {
            $exercises->where('zone_id', $this->zone);
        }
        if ($this->favorites) {
            $favorites = auth()->user()->favorites->pluck('id');

            $exercises->whereIn('id', $favorites);
        }

        return view('livewire.personal-trainer.exercises.index', [
            'exercises' => $exercises->paginate(10),
            'areas' => $areas,
            'typologies' => $typologies,
            'zones' => $zones
        ]);
    }
}
