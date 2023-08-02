<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    public function series()
    {
        return $this->belongsToMany(WorkoutSerie::class, 'exercise_workout_serie', 'exercise_id', 'workout_serie_id');
    }

    public function typology()
    {
        return $this->belongsTo(ExerciseTypology::class);
    }

    public function zone()
    {
        return $this->belongsTo(ExerciseZone::class);
    }

    public function area()
    {
        return $this->belongsTo(ExerciseArea::class);
    }
}
