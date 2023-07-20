<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutWeek extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    public function workout_days()
    {
        return $this->hasMany(WorkoutDay::class);
    }
}
