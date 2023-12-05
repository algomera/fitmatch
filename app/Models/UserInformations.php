<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInformations extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $casts = [
        'dob' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
