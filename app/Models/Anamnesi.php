<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anamnesi extends Model
{
    use HasFactory;

    protected $casts = [
        'smoke_stopped_since' => 'datetime'
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
