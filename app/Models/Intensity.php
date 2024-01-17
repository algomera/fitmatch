<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intensity extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function exercises()
    {
        return $this->hasMany(WorkoutSerieItem::class)->where('item_type', Exercise::class);
    }
}
