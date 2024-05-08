<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = [
        'branch_id',
        'barangay',
        'delivering_fee',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // Define the relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

