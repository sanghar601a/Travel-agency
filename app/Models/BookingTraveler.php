<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingTraveler extends Model
{
    protected $fillable = ['booking_id', 'full_name', 'age', 'passport_number', 'gender'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
