<?php

// app/Models/User.php

// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username', 'email', 'password', 'firstName', 'lastName', 'middleName', 'address', 'gender', 'age', 'role', 'clinic_id', 'picture'
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Adjust the relationship to BelongsTo
    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }

    // Add a relationship to appointments
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    
}

