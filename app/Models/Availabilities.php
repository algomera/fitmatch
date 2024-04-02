<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availabilities extends Model
{
    use HasFactory;
    protected $table = 'availabilities';

    public function personalTrainer()
    {
        return $this->belongsTo(User::class, 'personal_trainer_id');
    }
}
