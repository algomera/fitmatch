<?php

namespace App\Http\Livewire\PersonalTrainer\Partials;

use App\Models\User;
use Livewire\Component;

class Informations extends Component
{

    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

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

    public function render()
    {
        return view('livewire.personal-trainer.partials.informations');
    }
}
