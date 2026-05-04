<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'tour_departure_id', 'booking_number', 'guest_count', 
        'total_price', 'commission_amount', 'vendor_earning', 'status', 
        'payment_status', 'payment_method', 'user_notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function departure()
    {
        return $this->belongsTo(TourDeparture::class, 'tour_departure_id');
    }

    public function travelers()
    {
        return $this->hasMany(BookingTraveler::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
