<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalTrainerTime extends Model
{
    use HasFactory;

    protected $table = 'personal_trainer_times';

    public function personalTrainer()
    {
        return $this->belongsTo(User::class, 'personal_trainer_id');
    }
}
