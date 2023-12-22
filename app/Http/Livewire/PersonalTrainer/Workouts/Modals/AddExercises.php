<?php

namespace App\Http\Livewire\PersonalTrainer\Workouts\Modals;

use App\Models\Exercise;
use App\Models\ExerciseArea;
use App\Models\ExerciseTypology;
use App\Models\ExerciseZone;
use App\Models\Intensity;
use App\Models\Repetition;
use App\Models\Workout;
use App\Models\WorkoutDay;
use App\Models\WorkoutSerie;
use App\Models\WorkoutSet;
use App\Models\WorkoutWeek;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;

class AddExercises extends ModalComponent
{
    use WithPagination;

    public Workout $workout;
    public WorkoutWeek $week;
    public WorkoutDay $day;
    public WorkoutSerie $serie;

    public $zones = [];
    public $areas = [];
    public $typology = null;
    public $zone = null;
    public $area = null;
    public $favorites = false;

    protected $listeners = [
        'add-exercise' => 'addExercise',
        'toggleFavorite' => '$refresh',
    ];

    public static function modalMaxWidthClass(): string
    {
        return 'sm:max-w-[98vw] sm:min-h-[850px] sm:max-h-[92vh]';
    }

    public function mount(Workout $workout, WorkoutWeek $week, WorkoutDay $day, WorkoutSet $set, WorkoutSerie $serie)
    {
        $this->workout = $workout;
        $this->week = $week;
        $this->day = $day;
        $this->serie = $serie;
    }

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

    public function addExercise($id, $repetitions, $intensity)
    {
        $this->serie->items()->create([
            'workout_id' => $this->workout->id,
            'item_id' => $id,
            'item_type' => Exercise::class,
            'intensity_id' => $intensity
        ]);
        $repetition = Repetition::create([
            'workout_id' => $this->workout->id,
            'workout_week_id' => $this->week->id,
            'quantity' => $repetitions
        ]);
        $this->serie->items()->create([
            'workout_id' => $this->workout->id,
            'item_id' => $repetition->id,
            'item_type' => Repetition::class
        ]);

        $this->emit('item-added', $id);
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
        $typologies = ExerciseTypology::all();

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

        return view('livewire.personal-trainer.workouts.modals.add-exercises', [
            'exercises' => $exercises->paginate(10),
            'typologies' => $typologies,
            'zones' => $this->zones,
            'areas' => $this->areas,
            'intensities' => Intensity::all(),
        ]);
    }
}
