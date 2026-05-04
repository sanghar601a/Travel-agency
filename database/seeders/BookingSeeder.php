<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $travelers = \App\Models\User::where('role', 'traveler')->get();
        $departures = \App\Models\TourDeparture::with('tour.vendor')->get();

        foreach (range(1, 10) as $i) {
            $departure = $departures->random();
            $traveler = $travelers->random();
            
            $num_travelers = rand(1, 3);
            $total_price = $departure->tour->base_price * $num_travelers;
            $commission = $total_price * 0.15;
            $vendor_earning = $total_price - $commission;

            $booking = \App\Models\Booking::create([
                'user_id' => $traveler->id,
                'tour_departure_id' => $departure->id,
                'booking_number' => 'BK-' . strtoupper(\Illuminate\Support\Str::random(8)),
                'guest_count' => $num_travelers,
                'total_price' => $total_price,
                'commission_amount' => $commission,
                'vendor_earning' => $vendor_earning,
                'status' => 'confirmed',
                'payment_status' => 'paid',
            ]);

            // Create Payment
            \App\Models\Payment::create([
                'booking_id' => $booking->id,
                'amount' => $total_price,
                'gateway' => 'stripe',
                'transaction_id' => 'ch_' . \Illuminate\Support\Str::random(24),
                'status' => 'completed',
            ]);

            // Add to vendor wallet
            $vendor = $departure->tour->vendor;
            $wallet = \App\Models\Wallet::firstOrCreate(
                ['vendor_id' => $vendor->id],
                ['balance' => 0]
            );
            $wallet->increment('balance', $vendor_earning);
        }
    }
}
