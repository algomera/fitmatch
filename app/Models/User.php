<?php

namespace App\Models;

use App\Traits\Searchable;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Searchable;

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

    public function getAgeAttribute()
    {
        return Carbon::parse($this->informations->dob)->age;
    }

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

    public function haveAccessToAnamnesiOf($anamnesi_id)
    {
        return $this->shared_anamnesis()->where('anamnesi_id', $anamnesi_id)->where('personal_trainer_id', $this->id)->exists();
    }

    public function shared_anamnesis()
    {
        return $this->belongsToMany(Anamnesi::class, 'anamnesi_personal_trainer', 'personal_trainer_id', 'anamnesi_id');
    }

    public function anamnesiAccepted($anamnesi_id)
    {
        return $this->shared_anamnesis()->where('anamnesi_id', $anamnesi_id)->where('personal_trainer_id', $this->id)->where('accepted', 1)->exists();
    }

    public function anamnesi()
    {
        return $this->hasOne(Anamnesi::class, 'athlete_id');
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

    public function favorites()
    {
        return $this->belongsToMany(Exercise::class, 'favorite_exercises');
    }
}
