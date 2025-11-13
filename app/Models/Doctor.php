<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'specialty', 'avatar_url',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
