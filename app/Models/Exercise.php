<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    public function personalTrainers()
    {
        return $this->belongsToMany(User::class, 'favorite_exercises');
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
