<?php

// app\Models\Audit.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $fillable = ['inventory_id', 'upc', 'name', 'description', 'old_quantity', 'quantity', 'type'];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}