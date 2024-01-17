<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anamnesi extends Model
{
    use HasFactory;


    protected $casts = [
        'smoke_stopped_since' => 'datetime',
        'coffee' => 'boolean',
        'regular_urination' => 'boolean',
        'regular_defecation' => 'boolean',
        'drug_therapies' => 'boolean',
        'drugs_in_past' => 'boolean',
        'nutritional_supplements' => 'boolean',
        'nutritional_supplements_in_past' => 'boolean',
        'traumas' => 'boolean',
        'pacemaker' => 'boolean',
        'allergies' => 'boolean',
        'intolerances' => 'boolean',
        'digestive_difficulties' => 'boolean',
        'bruxism' => 'boolean',
        'wake_up_at_night' => 'boolean',
        'eating_disorders' => 'boolean',
        'diabets' => 'boolean',
        'hypertension' => 'boolean',
        'dyslipidemia' => 'boolean',
        'thyroid_pathology' => 'boolean',
        'cardiovascular_diseases' => 'boolean',
        'obesity' => 'boolean',
        'contraceptives' => 'boolean',
        'pregnancies' => 'boolean',
        'increase_training_duration' => 'boolean',
        'increase_weekly_training_frequencies' => 'boolean',
        'articular_pain' => 'boolean',
        'know_basic_movements_of_weight_room' => 'boolean',
        'know_complementary_movements_of_weight_room' => 'boolean',
        'easily_prepare_your_meals' => 'boolean',
        'hunger_pangs_throughout_the_day' => 'boolean',
    ];

    public function athlete()
    {
        return $this->belongsTo(User::class, 'athlete_id');
    }

    public function personal_trainers()
    {
        return $this->belongsToMany(User::class, 'anamnesi_personal_trainer', 'anamnesi_id', 'personal_trainer_id');
    }
}
