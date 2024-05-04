<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'appointment_date',
        'appointment_slot',
        'user_id',
        'status',
        'branch_id',
        'pet_name',
        'animal_type',
        'breed',
        'service_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    // Define the relationship with PetHotel
    public function petHotel()
    {
        return $this->hasOne(PetHotel::class);
    }
}
