<?php

namespace App\Models;

use Carbon\Carbon;
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
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
