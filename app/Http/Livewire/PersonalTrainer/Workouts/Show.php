<?php

namespace App\Http\Livewire\PersonalTrainer\Workouts;

use App\Models\Cargo;
use App\Models\Exercise;
use App\Models\Recovery;
use App\Models\Repetition;
use App\Models\Workout;
use App\Models\WorkoutDay;
use App\Models\WorkoutExercise;
use App\Models\WorkoutSerie;
use App\Models\WorkoutSet;
use App\Models\WorkoutWeek;
use Livewire\Component;

class Show extends Component
{
    public $workout;
    public $athlete;
    public $weeks;
    public $selectedWeek = 1;
    public $selectedWeekId = null;
    public $selectedDay = null;
    public $hasDataToCopy = false;
    public $weekToCopy = null;
    public $selectedSerie = null;

    protected $listeners = [
        'day-added' => '$refresh',
        'item-added' => '$refresh',
        'item-deleted' => '$refresh',
        'pasteWeek'
    ];

    public function mount(Workout $workout)
    {
        $this->workout = $workout;
        $this->athlete = $workout->athlete;
        $this->weeks = $workout->workout_weeks()->whereHas('workout_days')->get();
        $this->selectedWeekId = $this->weeks->first()->id ?? $workout->workout_weeks->first()->id;
        $this->selectedDay = $workout->workout_days()->orderBy('day')->first()->id ?? null;
    }

    public function requestAnamnesiAccess()
    {
        if (!auth()->user()->shared_anamnesis()->where('anamnesi_id', $this->athlete->anamnesi->id)->exists()) {
            auth()->user()->shared_anamnesis()->attach($this->athlete->anamnesi->id, [
                'accepted' => false,
                'created_at' => now()
            ]);
        }

        $this->dispatchBrowserEvent('open-notification', [
            'title' => __('Richiesta Inviata'),
            'subtitle' => __("La richiesta di accesso all'anamnesi di <strong>{$this->athlete->full_name}</strong> è stata inviata correttamente"),
            'type' => 'success'
        ]);
    }

    public function cancelAnamnesiAccess()
    {
        auth()->user()->shared_anamnesis()->detach($this->athlete->anamnesi->id);

        $this->dispatchBrowserEvent('open-notification', [
            'title' => __('Richiesta Annullata'),
            'subtitle' => __("La richiesta di accesso all'anamnesi di <strong>{$this->athlete->full_name}</strong> è stata annullata"),
            'type' => 'success'
        ]);
    }

    public function updatedselectedWeekId()
    {
        $week = WorkoutWeek::find($this->selectedWeekId);
        $this->selectedWeek = $week->week;
        $this->selectedWeekId = $week->id;
        $this->selectedDay = $week->workout_days()->orderBy('day')->first()->id ?? null;
    }

    public function copyWeek(WorkoutWeek $week)
    {
        $this->hasDataToCopy = true;
        $this->weekToCopy = $week->id;
        $this->dispatchBrowserEvent('open-notification', [
            'title' => __('Settimana Copiata'),
            'type' => 'success',
        ]);
    }

    public function pasteWeek()
    {
        $original_week = WorkoutWeek::find($this->weekToCopy);
        $cloned_week = WorkoutWeek::find($this->selectedWeekId);

        // Cancello i giorni esistenti
        $cloned_week->workout_days->each(function ($day) {
            $day->delete();
        });

        foreach ($original_week->workout_days as $workout_day) {
            $newDay = $workout_day->replicate()->fill([
                'workout_week_id' => $this->selectedWeekId
            ]);
            $newDay->save();
            $workout_day->workout_sets->each(function ($set) use ($cloned_week, $newDay) {
                $newSet = $set->replicate()->fill([
                    'workout_id' => $this->workout->id,
                    'workout_day_id' => $newDay->id
                ]);
                $newSet->save();
                $set->workout_series->each(function ($serie) use ($cloned_week, $newSet) {
                    $newSerie = $serie->replicate()->fill([
                        'workout_id' => $this->workout->id,
                        'workout_set_id' => $newSet->id
                    ]);
                    $newSerie->save();
                    $serie->items->each(function ($item) use ($cloned_week, $newSerie) {
                        switch ($item->item_type) {
                            case Repetition::class:
                                $repetition = Repetition::create([
                                    'workout_id' => $item->repetition->workout_id,
                                    'workout_week_id' => $item->repetition->workout_week_id,
                                    'quantity' => $item->repetition->quantity,
                                ]);
                                $newSerie->items()->create([
                                    'workout_id' => $this->workout->id,
                                    'item_id' => $repetition->id,
                                    'item_type' => Repetition::class
                                ]);
                                break;
                            case Recovery::class:
                                $recovery = Recovery::create([
                                    'workout_id' => $item->recovery->workout_id,
                                    'workout_week_id' => $item->recovery->workout_week_id,
                                    'quantity' => $item->recovery->quantity,
                                ]);
                                $newSerie->items()->create([
                                    'workout_id' => $this->workout->id,
                                    'item_id' => $recovery->id,
                                    'item_type' => Recovery::class
                                ]);
                                break;
                            case Cargo::class:
                                $cargo = Cargo::create([
                                    'workout_id' => $item->cargo->workout_id,
                                    'workout_week_id' => $item->cargo->workout_week_id,
                                    'quantity' => $item->cargo->quantity,
                                ]);
                                $newSerie->items()->create([
                                    'workout_id' => $this->workout->id,
                                    'item_id' => $cargo->id,
                                    'item_type' => Cargo::class
                                ]);
                                break;
                            case Exercise::class:
                                $exercise = $item->replicate();
                                $newSerie->items()->create([
                                    'workout_id' => $newSerie->workout->id,
                                    'item_id' => $exercise->item_id,
                                    'item_type' => Exercise::class
                                ]);
                                break;
                        }
                    });
                });
            });
        }

        $this->selectedDay = $cloned_week->workout_days()->orderBy('day')->first()->id ?? null;

        $this->hasDataToCopy = false;
        $this->weekToCopy = null;
        $this->dispatchBrowserEvent('open-notification', [
            'title' => __('Settimana Incollata'),
            'type' => 'success',
        ]);
    }

    public function addDay($id)
    {
        $day = WorkoutDay::create([
            'workout_id' => $this->workout->id,
            'workout_week_id' => $this->selectedWeekId,
            'day' => $id
        ]);

        $set = WorkoutSet::create([
            'workout_id' => $this->workout->id,
            'workout_day_id' => $day->id
        ]);

        $serie = WorkoutSerie::create([
            'workout_id' => $this->workout->id,
            'workout_set_id' => $set->id
        ]);

        $this->selectedDay = $day->id;
    }

    public function deleteDay(WorkoutDay $day)
    {
        foreach ($day->workout_sets as $set) {
            $this->deleteSet($set);
        }
        $day->workout_sets()->delete();
        $day->delete();
        $this->selectedDay = $this->workout->workout_days()->where('workout_week_id', $this->selectedWeekId)->orderBy('day')->first()->id ?? null;
    }

    public function deleteSet(WorkoutSet $set)
    {
        foreach ($set->workout_series as $serie) {
            foreach ($serie->items as $item) {
                if ($item->item_type !== Exercise::class) {
                    $item->item_type::where('id', $item->item_id)->delete();
                }
            }
            $serie->items()->delete();
            $serie->delete();
        }
        $set->delete();
    }

    public function addRepetition(WorkoutSerie $serie)
    {
        $repetition = Repetition::create([
            'workout_id' => $this->workout->id,
            'workout_week_id' => $this->selectedWeekId
        ]);
        $serie->items()->create([
            'workout_id' => $this->workout->id,
            'item_id' => $repetition->id,
            'item_type' => Repetition::class
        ]);
    }

    public function addRecovery(WorkoutSerie $serie)
    {
        $recovery = Recovery::create([
            'workout_id' => $this->workout->id,
            'workout_week_id' => $this->selectedWeekId
        ]);
        $serie->items()->create([
            'workout_id' => $this->workout->id,
            'item_id' => $recovery->id,
            'item_type' => Recovery::class
        ]);
    }

    public function addCargo(WorkoutSerie $serie)
    {
        $cargo = Cargo::create([
            'workout_id' => $this->workout->id,
            'workout_week_id' => $this->selectedWeekId
        ]);
        $serie->items()->create([
            'workout_id' => $this->workout->id,
            'item_id' => $cargo->id,
            'item_type' => Cargo::class
        ]);
    }

    public function deleteSerie(WorkoutSerie $serie)
    {
        foreach ($serie->items as $item) {
            if ($item->item_type !== Exercise::class) {
                $item->item_type::find($item->item_id)->delete();
            }
        }
        $serie->delete();
    }

    public function addSerie(WorkoutSet $set)
    {
        $set->workout_series()->create([
            'workout_id' => $this->workout->id,
        ]);
    }

    public function addSet($day)
    {
        $set = WorkoutSet::create([
            'workout_id' => $this->workout->id,
            'workout_day_id' => $day
        ]);
        $serie = WorkoutSerie::create([
            'workout_id' => $this->workout->id,
            'workout_set_id' => $set->id
        ]);
    }

    public function duplicateSerieHorizontal(WorkoutSerie $serie)
    {
        $itemsReversed = $serie->items->reverse();

        $foundExercise = false;
        $itemsToDuplicate = collect();

        foreach ($itemsReversed as $item) {
            $itemsToDuplicate->prepend($item);

            if ($item->item_type === 'App\Models\Exercise') {
                $foundExercise = true;
                break;
            }
        }

        if ($foundExercise) {
            $itemsToDuplicate->each(function ($item) use ($serie) {
                switch ($item->item_type) {
                    case Repetition::class:
                        $repetition = Repetition::create([
                            'workout_id' => $item->repetition->workout_id,
                            'workout_week_id' => $item->repetition->workout_week_id,
                            'quantity' => $item->repetition->quantity,
                        ]);
                        $serie->items()->create([
                            'workout_id' => $this->workout->id,
                            'item_id' => $repetition->id,
                            'item_type' => Repetition::class
                        ]);
                        break;
                    case Recovery::class:
                        $recovery = Recovery::create([
                            'workout_id' => $item->recovery->workout_id,
                            'workout_week_id' => $item->recovery->workout_week_id,
                            'quantity' => $item->recovery->quantity,
                        ]);
                        $serie->items()->create([
                            'workout_id' => $this->workout->id,
                            'item_id' => $recovery->id,
                            'item_type' => Recovery::class
                        ]);
                        break;
                    case Cargo::class:
                        $cargo = Cargo::create([
                            'workout_id' => $item->cargo->workout_id,
                            'workout_week_id' => $item->cargo->workout_week_id,
                            'quantity' => $item->cargo->quantity,
                        ]);
                        $serie->items()->create([
                            'workout_id' => $this->workout->id,
                            'item_id' => $cargo->id,
                            'item_type' => Cargo::class
                        ]);
                        break;
                    case Exercise::class:
                        $exercise = $item->replicate();
                        $serie->items()->create([
                            'workout_id' => $serie->workout->id,
                            'item_id' => $exercise->item_id,
                            'item_type' => Exercise::class
                        ]);
                        break;
                }
            });
        }
    }

    public function duplicateSerieVertical(WorkoutSerie $serie)
    {
        $newSerie = WorkoutSerie::create([
            'workout_id' => $serie->workout_id,
            'workout_set_id' => $serie->workout_set_id
        ]);

        $serie->items->each(function ($item) use ($newSerie) {
            switch ($item->item_type) {
                case Repetition::class:
                    $repetition = Repetition::create([
                        'workout_id' => $item->repetition->workout_id,
                        'workout_week_id' => $item->repetition->workout_week_id,
                        'quantity' => $item->repetition->quantity,
                    ]);
                    $newSerie->items()->create([
                        'workout_id' => $this->workout->id,
                        'item_id' => $repetition->id,
                        'item_type' => Repetition::class
                    ]);
                    break;
                case Recovery::class:
                    $recovery = Recovery::create([
                        'workout_id' => $item->recovery->workout_id,
                        'workout_week_id' => $item->recovery->workout_week_id,
                        'quantity' => $item->recovery->quantity,
                    ]);
                    $newSerie->items()->create([
                        'workout_id' => $this->workout->id,
                        'item_id' => $recovery->id,
                        'item_type' => Recovery::class
                    ]);
                    break;
                case Cargo::class:
                    $cargo = Cargo::create([
                        'workout_id' => $item->cargo->workout_id,
                        'workout_week_id' => $item->cargo->workout_week_id,
                        'quantity' => $item->cargo->quantity,
                    ]);
                    $newSerie->items()->create([
                        'workout_id' => $this->workout->id,
                        'item_id' => $cargo->id,
                        'item_type' => Cargo::class
                    ]);
                    break;
                case Exercise::class:
                    $exercise = $item->replicate();
                    $newSerie->items()->create([
                        'workout_id' => $newSerie->workout->id,
                        'item_id' => $exercise->item_id,
                        'item_type' => Exercise::class
                    ]);
                    break;
            }
        });
    }

    public function updatedSelectedWeek()
    {
        $this->selectedDay = $this->workout->workout_days()->where('workout_week_id', $this->selectedWeekId)->first()->id ?? null;
    }

    public function render()
    {
        return view('livewire.personal-trainer.workouts.show', [
            'days' => $this->workout->workout_days()->where('workout_week_id', $this->selectedWeekId)->orderBy('day')->get(),
            'sets' => WorkoutSet::where('workout_day_id', $this->selectedDay)->get(),
        ]);
    }
}
