<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;

class Block extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id','starts_at','duration_minutes','notes'];

    protected $casts = [
        'starts_at' => 'datetime',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
