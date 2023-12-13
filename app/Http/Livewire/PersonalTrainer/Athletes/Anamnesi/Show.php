<?php

namespace App\Http\Livewire\PersonalTrainer\Athletes\Anamnesi;

use App\Models\Anamnesi;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class Show extends ModalComponent
{
    public Anamnesi $anamnesi;
    public User $athlete;
    public $tabs = [
        'personal_data' => [
            'label' => 'Dati Anagrafici'
        ],
        'work' => [
            'label' => 'Lavoro'
        ],
        'physiology' => [
            'label' => 'Fisiologia',
            'children' => [
                'smoke_and_alcool' => 'Fumo e Bevande',
                'bladder_and_intestine' => 'Vescica e Intestino',
                'drugs' => 'Farmaci',
                'diet' => 'Dieta',
                'sleep' => 'Sonno',
                'pathologies' => 'Patologie',
                'mestrual_cycle' => 'Ciclo Mestruale'
            ]
        ],
        'anthropometric_measurements' => [
            'label' => 'Misure Antropometriche'
        ],
        'general_informations' => [
            'label' => 'Informazioni Generali',
            'children' => [
                'sports' => 'Attività Sportiva',
                'training_techniques' => 'Tecniche di allenamento',
                'meals' => 'Preparazione e consumo pasti'
            ]
        ],
        'nutritional' => [
            'label' => 'Nutrizionale',
            //            'children' => [
            //                'breakfast' => 'Colazione',
            //                'morning_snack' => 'Spuntino del mattino',
            //                'lunch' => 'Pranzo',
            //                'afternoon_snack' => 'Spuntino del pomeriggio',
            //                'dinner' => 'Cena',
            //                'pre-nanna' => 'Prenanna',
            //            ]
        ]
    ];
    public $selectedTab = 'personal_data';

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public function mount()
    {
        $this->athlete = $this->anamnesi->athlete;
    }

    public function render()
    {
        return view('livewire.personal-trainer.athletes.anamnesi.show');
    }
}
