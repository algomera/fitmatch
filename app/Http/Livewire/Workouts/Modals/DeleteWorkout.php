<?php

namespace App\Http\Livewire\Workouts\Modals;

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
