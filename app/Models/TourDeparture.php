<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourDeparture extends Model
{
    use SoftDeletes;
    protected $fillable = ['tour_id', 'start_date', 'end_date', 'available_seats', 'status'];

    public function tour() { return $this->belongsTo(Tour::class); }
    public function bookings() { return $this->hasMany(Booking::class); }
}
