<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'image',
        'category',
        'price',
        'upc',
        'created_at',
        'expiration',
        'branch_id', // Add the foreign key for the clinic
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    


}
