<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutDay extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function workout_week()
    {
        return $this->belongsTo(WorkoutWeek::class);
    }

    public function workout_sets()
    {
        return $this->hasMany(WorkoutSet::class);
    }
}
