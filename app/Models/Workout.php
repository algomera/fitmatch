<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    protected $casts = [
        'start_date' => 'date:Y-m-d',
    ];

    public function scopeAssigned(Builder $query)
    {
        $query->whereNot('athlete_id');
    }

    public function scopeNotAssigned(Builder $query)
    {
        $query->where('athlete_id', null);
    }

    public function getEndDateAttribute()
    {
        return Carbon::parse($this->start_date)->addWeeks($this->duration);
    }

    public function personal_trainer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function athlete()
    {
        return $this->belongsTo(User::class, 'athlete_id', 'id');
    }
}
