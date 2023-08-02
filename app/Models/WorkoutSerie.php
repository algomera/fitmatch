<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutSerie extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function set()
    {
        return $this->belongsTo(WorkoutSet::class);
    }

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'exercise_workout_serie', 'workout_serie_id', 'exercise_id');
    }
}
