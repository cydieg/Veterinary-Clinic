<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetHotel extends Model
{
    use HasFactory;

    protected $fillable = ['appointment_id', 'check_out_date', 'size', 'price'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
