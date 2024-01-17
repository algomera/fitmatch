<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutSet extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function day()
    {
        return $this->belongsTo(WorkoutDay::class);
    }

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    public function workout_series()
    {
        return $this->hasMany(WorkoutSerie::class);
    }
}
