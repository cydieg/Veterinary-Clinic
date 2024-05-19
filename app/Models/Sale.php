<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'branch_id',
        'courier', // Add the courier attribute to the $fillable array
        'total_price',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Inventory::class, 'product_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function audit()
    {
        return $this->hasOne(Audit::class, 'sale_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function getFeeAttribute()
    {
        return Fee::where('barangay', $this->user->barangay)->first();
    }
}
