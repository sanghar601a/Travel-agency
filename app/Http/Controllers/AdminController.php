<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendor;
use App\Models\Booking;
use App\Models\Tour;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VendorApprovedMail;
use App\Mail\VendorSuspendedMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_vendors' => Vendor::count(),
            'total_bookings' => Booking::count(),
            'platform_revenue' => Booking::sum('total_price'),
            'active_tours' => Tour::where('status', 'active')->count(),
        ];

        $recentBookings = Booking::with(['user', 'departure.tour'])->latest()->take(5)->get();
        $pendingVendors = Vendor::where('status', 'pending')->with('user')->get();

        return view('admin-panel.dashboard', compact('stats', 'recentBookings', 'pendingVendors'));
    }

    public function vendors(Request $request)
    {
        $query = Vendor::with(['user', 'tours']);

        // Search Filter
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('agency_name', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function($u) use ($request) {
                      $u->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        // Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Category Filter (Filter vendors who have tours in this category)
        if ($request->filled('category')) {
            $query->whereHas('tours', function($q) use ($request) {
                $q->where('category_id', $request->category);
            });
        }

        $vendors = $query->latest()->get();
        $categories = \App\Models\Category::all();

        return view('admin-panel.vendors', compact('vendors', 'categories'));
    }

    public function markNotificationsRead()
    {
        Vendor::where('status', 'pending')->update(['is_notified' => true]);
        return response()->json(['success' => true]);
    }

    public function updateVendorStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,suspended,rejected'
        ]);

        $vendor = Vendor::findOrFail($id);
        $vendor->update(['status' => $request->status]);

        // Send Email Notifications
        try {
            if ($request->status === 'active') {
                Mail::to($vendor->user->email)->send(new VendorApprovedMail($vendor));
            } elseif ($request->status === 'suspended') {
                Mail::to($vendor->user->email)->send(new VendorSuspendedMail($vendor));
            }
        } catch (\Exception $e) {
            \Log::error("Mail failed: " . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Vendor status updated and notification sent.');
    }

    public function bookings()
    {
        $bookings = Booking::with(['user', 'departure.tour'])->latest()->get();
        return view('admin-panel.bookings', compact('bookings'));
    }

    public function payouts()
    {
        $active = 'payouts';
        return view('admin-panel.payouts', compact('active'));
    }

    public function profile()
    {
        return view('admin-panel.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password changed successfully.');
    }
}
