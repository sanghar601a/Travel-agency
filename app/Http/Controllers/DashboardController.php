<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Fetch traveler stats
        $stats = [
            'total_bookings' => Booking::where('user_id', $user->id)->count(),
            'total_spent' => Booking::where('user_id', $user->id)->sum('total_price'),
            'visited_places' => Booking::where('user_id', $user->id)
                ->where('bookings.status', 'confirmed')
                ->join('tour_departures', 'bookings.tour_departure_id', '=', 'tour_departures.id')
                ->join('tours', 'tour_departures.tour_id', '=', 'tours.id')
                ->distinct('tours.location')
                ->count(),
            'saved_tours' => $user->wishlistedTours()->count(),
        ];

        // Fetch recent bookings
        $recentBookings = Booking::with(['departure.tour'])
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $active = 'dashboard';
        return view('frontend.pages.dashboard', compact('stats', 'recentBookings', 'active'));
    }

    public function bookings()
    {
        $user = Auth::user();
        $bookings = Booking::with(['departure.tour'])->where('user_id', $user->id)->latest()->get();
        $active = 'bookings';
        return view('frontend.pages.dashboard-bookings', compact('bookings', 'active'));
    }

    public function wishlist()
    {
        $user = Auth::user();
        $wishlistedTours = $user->wishlistedTours()->with(['images', 'category', 'departures'])->latest()->get();
        $active = 'wishlist';
        return view('frontend.pages.dashboard-wishlist', compact('active', 'wishlistedTours'));
    }

    public function transactions()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)->latest()->get();
        $active = 'transactions';
        return view('frontend.pages.dashboard-transactions', compact('bookings', 'active'));
    }
}
