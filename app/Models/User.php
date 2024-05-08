<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username', 'firstName', 'lastName', 'middleName', 'address', 'region', 'province', 'city', 'barangay', 'gender', 'age', 'email', 'role', 'password', 'branch_id', 'contact_number', 'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    // Define the relationship between User and Fee
    public function fees()
    {
        return $this->hasMany(Fee::class, 'user_id');
    }
}
