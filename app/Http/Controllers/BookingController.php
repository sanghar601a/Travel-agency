<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\TourDeparture;
use App\Models\Booking;
use App\Models\BookingTraveler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function checkout(Request $request)
    {
        if (!$request->departure_id) {
            return back()->with('error', 'Please select a travel date before proceeding to checkout.');
        }

        $tour = Tour::findOrFail($request->tour_id);
        $departure = TourDeparture::findOrFail($request->departure_id);
        $guests = $request->query('guests', 1);
        
        $total_price = $tour->base_price * $guests;

        return view('frontend.pages.checkout', compact('tour', 'departure', 'guests', 'total_price'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'departure_id' => 'required|exists:tour_departures,id',
            'guests' => 'required|integer|min:1',
            'payment' => 'required|in:stripe,bank,easypaisa',
            'travelers' => 'required|array',
            'travelers.*.name' => 'required|string',
            'travelers.*.age' => 'required|integer',
        ]);

        $departure = TourDeparture::with('tour')->findOrFail($request->departure_id);
        $tour = $departure->tour;

        if ($departure->available_seats < $request->guests) {
            return back()->with('error', 'Sorry, not enough seats available for this date.');
        }

        return DB::transaction(function () use ($request, $departure, $tour) {
            $total_price = $tour->base_price * $request->guests;
            
            // Commission calculation (e.g., 10%)
            $commission_rate = 0.10;
            $commission_amount = $total_price * $commission_rate;
            $vendor_earning = $total_price - $commission_amount;

            // Initial Status Logic
            // If Stripe, we assume instant confirmation for this demo. 
            // In real world, you'd handle Stripe Webhook.
            $status = ($request->payment === 'stripe') ? 'confirmed' : 'pending';
            $payment_status = ($request->payment === 'stripe') ? 'paid' : 'unpaid';

            // Create Booking
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'tour_departure_id' => $departure->id,
                'booking_number' => 'PT-' . strtoupper(Str::random(8)),
                'total_price' => $total_price,
                'guest_count' => $request->guests,
                'commission_amount' => $commission_amount,
                'vendor_earning' => $vendor_earning,
                'status' => $status,
                'payment_status' => $payment_status,
                'payment_method' => $request->payment,
            ]);

            // Create Travelers
            foreach ($request->travelers as $travelerData) {
                BookingTraveler::create([
                    'booking_id' => $booking->id,
                    'full_name' => $travelerData['name'],
                    'age' => $travelerData['age'],
                ]);
            }

            // Update Inventory if confirmed
            if ($status === 'confirmed') {
                $departure->decrement('available_seats', $request->guests);
            }

            $message = $status === 'confirmed' 
                ? 'Booking confirmed! Your adventure is ready.' 
                : 'Booking submitted. Please complete payment for confirmation.';

            return redirect()->route('traveler.bookings')->with('success', $message);
        });
    }

    public function show($id)
    {
        $booking = Booking::with(['departure.tour', 'travelers'])->where('user_id', Auth::id())->findOrFail($id);
        return view('frontend.pages.booking-details', compact('booking'));
    }

    public function cancel($id)
    {
        $booking = Booking::with('departure')->where('user_id', Auth::id())->findOrFail($id);

        if (in_array($booking->status, ['cancelled', 'completed'])) {
            return back()->with('error', 'This booking cannot be cancelled.');
        }

        // 24 Hour Policy Check (Professional Standard)
        $departureDate = \Carbon\Carbon::parse($booking->departure->start_date);
        if (!now()->addHours(24)->lte($departureDate)) {
            return back()->with('error', 'Sorry, bookings can only be cancelled at least 24 hours before departure.');
        }

        DB::transaction(function () use ($booking) {
            $oldStatus = $booking->status;
            $booking->update(['status' => 'cancelled']);

            // If it was confirmed, restore the seats
            if ($oldStatus === 'confirmed') {
                $booking->departure->increment('available_seats', $booking->guest_count);
            }
        });

        return redirect()->route('traveler.bookings')->with('success', 'Your booking #' . $booking->booking_number . ' has been cancelled successfully.');
    }
}
