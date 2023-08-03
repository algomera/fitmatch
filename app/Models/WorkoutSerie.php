<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutSerie extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    public function sets()
    {
        return $this->hasMany(WorkoutSet::class);
    }

    public function items()
    {
        return $this->hasMany(WorkoutSerieItem::class);
    }
}
