<?php

namespace App\Http\Livewire\PersonalTrainer\Exercises;

use App\Models\Exercise;
use App\Models\ExerciseArea;
use App\Models\ExerciseTypology;
use App\Models\ExerciseZone;
use App\Models\Intensity;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $zones = [];
    public $areas = [];
    public $area = null;
    public $typology = null;
    public $zone = null;
    public $favorites = false;
    public $show;

    protected $queryString = [
        'favorites' => ['except' => false]
    ];

    protected $listeners = [
        'add-exercise' => 'addExercise',
        'toggleFavorite' => '$refresh',
    ];

    public function updatedTypology()
    {
        $this->resetPage();
        $this->reset(['zones', 'zone', 'areas', 'area']);
    }

    public function updatedZone()
    {
        $this->resetPage();
        $this->reset(['areas', 'area']);
    }

    public function updatedArea()
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

        if ($this->typology) {
            $exercises->where('typology_id', $this->typology);
            $zones = $exercises->clone()->get()->pluck('zone_id')->unique();
            $this->zones = ExerciseZone::whereIn('id', $zones)->get();
        }
        if ($this->zone) {
            $exercises->where('zone_id', $this->zone);
            $areas = $exercises->clone()->get()->pluck('area_id')->unique();
            $this->areas = ExerciseArea::whereIn('id', $areas)->get();
        }
        if ($this->area) {
            $exercises->where('area_id', $this->area);
        }
        if ($this->favorites) {
            $favorites = auth()->user()->favorites->pluck('id');

            $exercises->whereIn('id', $favorites);
        }

        return view('livewire.personal-trainer.exercises.index', [
            'exercises' => $exercises->paginate(10),
            'typologies' => $typologies,
            'zones' => $this->zones,
            'areas' => $this->areas,
            'intensities' => Intensity::all(),
        ]);
    }
}
