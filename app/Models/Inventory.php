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
        'subcategory', 
        'price',
        'upc',
        'created_at',
        'expiration',
        'branch_id',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    public static function expiringSoon($days = 7)
    {
        return self::where('expiration', '>=', now())
                    ->where('expiration', '<=', now()->addDays($days))
                    ->get();
    }
    
}
