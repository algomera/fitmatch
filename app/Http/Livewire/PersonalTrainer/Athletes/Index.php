<?php

namespace App\Http\Livewire\PersonalTrainer\Athletes;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public User $selectedAthlete;
    public $search = '';

    public function setAthlete($id)
    {
        $this->selectedAthlete = User::find($id);
    }

    public function requestAnamnesiAccess()
    {
        if (!auth()->user()->shared_anamnesis()->where('anamnesi_id', $this->selectedAthlete->anamnesi->id)->exists()) {
            auth()->user()->shared_anamnesis()->attach($this->selectedAthlete->anamnesi->id, [
                'accepted' => false,
                'created_at' => now()
            ]);
        }

        $this->dispatchBrowserEvent('open-notification', [
            'title' => __('Richiesta Inviata'),
            'subtitle' => __("La richiesta di accesso all'anamnesi di <strong>{$this->selectedAthlete->full_name}</strong> è stata inviata correttamente"),
            'type' => 'success'
        ]);
    }

    public function cancelAnamnesiAccess()
    {
        auth()->user()->shared_anamnesis()->detach($this->selectedAthlete->anamnesi->id);

        $this->dispatchBrowserEvent('open-notification', [
            'title' => __('Richiesta Annullata'),
            'subtitle' => __("La richiesta di accesso all'anamnesi di <strong>{$this->selectedAthlete->full_name}</strong> è stata annullata"),
            'type' => 'success'
        ]);
    }

    public function render()
    {
        $athletes = auth()->user()->athletes()->with('informations');
        if ($this->search) {
            $athletes->search($this->search, [
                'informations.first_name',
                'informations.last_name'
            ]);
        }
        return view('livewire.personal-trainer.athletes.index', [
            'athletes' => $athletes->get(),
        ]);
    }
}
