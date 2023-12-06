<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public function personalTrainer()
    {
        return $this->belongsTo(User::class, 'personal_trainer_id');
    }

    public function athlete()
    {
        return $this->belongsTo(User::class, 'athlete_id');
    }
}
