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

    public function items()
    {
        return $this->hasMany(WorkoutSerieItem::class);
    }
}
