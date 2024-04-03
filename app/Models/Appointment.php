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
        'appointment_time',
        'user_id',
        'status',
        'branch_id', // Add this line to the $fillable array
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

        public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    
}
