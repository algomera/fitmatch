<?php

namespace App\Http\Livewire\Workouts\Modals;

use App\Models\Cargo;
use App\Models\Recovery;
use App\Models\Repetition;
use App\Models\Workout;
use LivewireUI\Modal\ModalComponent;

class DeleteWorkout extends ModalComponent
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

    public function delete()
    {
        Repetition::where('workout_id', $this->workout->id)->delete();
        Recovery::where('workout_id', $this->workout->id)->delete();
        Cargo::where('workout_id', $this->workout->id)->delete();
        $this->workout->delete();
        $this->emit('workout-deleted');
        $this->closeModal();
        $this->dispatchBrowserEvent('open-notification', [
            'title' => __('Scheda eliminata'),
            'subtitle' => __("La scheda è stata eliminata!"),
            'type' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.workouts.modals.delete-workout');
    }
}
