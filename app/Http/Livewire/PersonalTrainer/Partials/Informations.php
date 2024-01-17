<?php

namespace App\Http\Livewire\PersonalTrainer\Partials;

use App\Models\User;
use Livewire\Component;

class Informations extends Component
{

    public $user;
    protected $rules = [
        'user.informations.dob' => 'required',
        'user.informations.phone' => 'required',
        'user.email' => 'required',
        'user.informations.bio' => 'required',
        'user.informations.company_name' => 'required',
        'user.informations.company_address' => 'required',
        'user.informations.company_civic' => 'required',
        'user.informations.company_city' => 'required',
        'user.informations.company_zip_code' => 'required',
        'user.informations.company_vat_number' => 'required',
        'user.informations.company_fiscal_code' => 'required',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function save()
    {
        $this->validate();
        $this->user->update([
            'email' => $this->user->email
        ]);
        $this->user->informations()->update([
            'dob' => $this->user->informations->dob,
            'phone' => $this->user->informations->phone,
            'bio' => $this->user->informations->bio,
            'company_name' => $this->user->informations->company_name,
            'company_address' => $this->user->informations->company_address,
            'company_civic' => $this->user->informations->company_civic,
            'company_city' => $this->user->informations->company_city,
            'company_zip_code' => $this->user->informations->company_zip_code,
            'company_vat_number' => $this->user->informations->company_vat_number,
            'company_fiscal_code' => $this->user->informations->company_fiscal_code,
        ]);

        $this->dispatchBrowserEvent('open-notification', [
            'title' => __('Aggiornamento'),
            'subtitle' => __("L'utente è stato aggiornato con successo."),
            'type' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.personal-trainer.partials.informations');
    }
}
