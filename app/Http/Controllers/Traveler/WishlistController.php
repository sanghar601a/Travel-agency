<?php

namespace App\Http\Controllers\Traveler;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Auth::user()->wishlistedTours()->latest()->get();
        return view('traveler.wishlist.index', compact('wishlists'));
    }

    public function toggle(Tour $tour)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Please login first'], 401);
        }

        $wishlist = Wishlist::where('user_id', $user->id)
            ->where('tour_id', $tour->id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            $action = 'removed';
        } else {
            Wishlist::create([
                'user_id' => $user->id,
                'tour_id' => $tour->id,
            ]);
            $action = 'added';
        }

        return response()->json([
            'status' => 'success',
            'action' => $action,
            'count' => $user->wishlistedTours()->count()
        ]);
    }
}
