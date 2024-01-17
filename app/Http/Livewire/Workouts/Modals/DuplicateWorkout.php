<?php

namespace App\Http\Livewire\Workouts\Modals;

use App\Models\Exercise;
use App\Models\Workout;
use LivewireUI\Modal\ModalComponent;

class DuplicateWorkout extends ModalComponent
{
    public $workout;

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function mount(Workout $workout)
    {
        $this->workout = $workout;
    }

    public function duplicate()
    {
        $newWorkout = $this->workout->replicate()->fill([
            'athlete_id' => null,
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
                                'item_id' => $ni->item_id
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
        return view('livewire.workouts.modals.duplicate-workout');
    }
}
