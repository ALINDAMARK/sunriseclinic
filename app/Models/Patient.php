<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'dob',
        // optional extended profile fields
        'gender', 'marital_status', 'address',
        'emergency_contact_name', 'emergency_contact_phone',
        'allergies', 'conditions',
    ];

    /**
     * Appointments for this patient.
     * Allows filtering patients by doctor via whereHas('appointments', ...)
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
