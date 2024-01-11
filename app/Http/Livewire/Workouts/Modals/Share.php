<?php

namespace App\Http\Livewire\Workouts\Modals;

use App\Models\Workout;
use LivewireUI\Modal\ModalComponent;

class Share extends ModalComponent
{
    public Workout $workout;
    public $sharing_method = 'pdf';
    public $to = '';

    public static function modalMaxWidth(): string
    {
        return 'sm';
    }

    public function share()
    {
        if ($this->sharing_method === 'pdf') {
            // Genera PDF e avvia salvataggio
        } elseif ($this->sharing_method === 'email') {
            // Genera PDF, inserisci allegato e invia alla email impostata
            $this->validate([
                'to' => 'required|email'
            ], [
                'to.required' => 'Il campo è richiesto.',
                'to.email' => 'Il campo deve essere un indirizzo valido.'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.workouts.modals.share');
    }
}
