<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $appends = ['full_name'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getRoleAttribute()
    {
        return $this->roles[0];
    }

    public function getFullNameAttribute()
    {
        if ($this->informations) {
            return "{$this->informations->first_name} {$this->informations->last_name}";
        } else {
            return null;
        }
    }

    public function informations()
    {
        return $this->hasOne(UserInformations::class);
    }

    public function personal_trainers()
    {
        return $this->belongsToMany(User::class, 'personal_trainer_athlete', 'athlete_id', 'personal_trainer_id');
    }

    public function athletes()
    {
        return $this->belongsToMany(User::class, 'personal_trainer_athlete', 'personal_trainer_id', 'athlete_id');
    }

    public function job_experiences()
    {
        return $this->hasMany(JobExperience::class);
    }

    public function specializations()
    {
        return $this->hasMany(Specialization::class);
    }

    public function medias()
    {
        return $this->hasMany(Media::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_users', 'user_id', 'category_id');
    }

    public function personal_trainer_workouts()
    {
        return $this->hasMany(Workout::class, 'user_id', 'id');
    }

    public function athlete_workouts()
    {
        return $this->hasMany(Workout::class, 'athlete_id', 'id');
    }
}
