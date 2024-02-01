<?php

namespace App\Http\Livewire\Workouts\Modals;

use App\Models\Exercise;
use App\Models\Goal;
use App\Models\Workout;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class DuplicateWorkout extends ModalComponent
{
    public $workout;
    public $assign = false;
    public $name;
    public $athlete_id = null;
    public $start_date;
    public $goal_id;

    protected $listeners = [
        'itemSelected'
    ];

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function itemSelected($val)
    {
        $this->athlete_id = $val;
    }

    public function mount(Workout $workout)
    {
        $this->workout = $workout;
        $this->name = $workout->name;
    }

    public function duplicate()
    {
        if ($this->assign) {
            $this->validate();
        } else {
            $this->validateOnly('name');
        }

        $newWorkout = $this->workout->replicate()->fill([
            'name' => $this->name,
            'athlete_id' => $this->athlete_id ?? $this->workout->athlete_id,
            'start_date' => $this->start_date ?? $this->workout->start_date,
            'goal_id' => $this->goal_id ?? $this->workout->goal_id
        ]);
        $newWorkout->save();
        $this->workout->workout_weeks()->each(function ($week) use ($newWorkout) {
            $newWeek = $week->replicate()->fill([
                'workout_id' => $newWorkout->id
            ]);
            $newWeek->save();
            $week->workout_days()->each(function ($day) use ($newWorkout, $newWeek) {
                $newDay = $day->replicate()->fill([
                    'workout_id' => $newWorkout->id,
                    'workout_week_id' => $newWeek->id
                ]);
                $newDay->save();
                $day->workout_sets->each(function ($set) use ($newWorkout, $newWeek, $newDay) {
                    $newSet = $set->replicate()->fill([
                        'workout_id' => $newWorkout->id,
                        'workout_day_id' => $newDay->id
                    ]);
                    $newSet->save();
                    $set->workout_series->each(function ($serie) use ($newWorkout, $newWeek, $newSet) {
                        $newSerie = $serie->replicate()->fill([
                            'workout_id' => $this->workout->id,
                            'workout_set_id' => $newSet->id
                        ]);
                        $newSerie->save();
                        $serie->items->each(function ($item) use ($newWorkout, $newWeek, $newSerie) {
                            if ($item->item_type !== Exercise::class) {
                                $ni = $item->item_type::find($item->item_id)->replicate()->fill([
                                    'workout_id' => $newWorkout->id,
                                    'workout_week_id' => $newWeek->id
                                ]);
                                $ni->save();
                            } else {
                                $ni = $item;
                            }
                            $newItem = $item->replicate()->fill([
                                'workout_id' => $newWorkout->id,
                                'workout_serie_id' => $newSerie->id,
                                'item_id' => $ni->item_id ?? $ni->id,
                                'intensity_id' => $ni->intensity_id ?? null,
                                'notes' => $ni->notes ?? null,
                            ]);
                            $newItem->save();
                        });
                    });
                });
            });
        });
        $this->emit('workout-duplicated');
        $this->closeModal();
        $this->dispatchBrowserEvent('open-notification', [
            'title' => __('Scheda duplicata'),
            'subtitle' => __("La scheda è stata duplicata!"),
            'type' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.workouts.modals.duplicate-workout', [
            'goals' => Goal::all()
        ]);
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'athlete_id' => [
                Rule::exists('personal_trainer_athlete')->where(function (Builder $query) {
                    return $query->where('personal_trainer_id', auth()->user()->id);
                })
            ],
            'start_date' => 'required|date|after_or_equal:today',
            'goal_id' => 'required|exists:goals,id'
        ];
    }
}
