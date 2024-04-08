<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name',
        'location',
        'contact',
        'status',
       
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'user_id');
    }
    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
    public function sales()
    {
        return $this->hasMany(Sale::class, 'branch_id');
    }
    
}