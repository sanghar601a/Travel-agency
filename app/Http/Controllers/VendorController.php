<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Booking;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    public function dashboard()
    {
        $vendor = Auth::user()->vendor;
        
        $stats = [
            'active_tours' => Tour::where('vendor_id', $vendor->id)->count(),
            'total_bookings' => Booking::whereHas('departure', function($q) use ($vendor) {
                $q->whereHas('tour', function($t) use ($vendor) {
                    $t->where('vendor_id', $vendor->id);
                });
            })->count(),
            'total_revenue' => Booking::whereHas('departure', function($q) use ($vendor) {
                $q->whereHas('tour', function($t) use ($vendor) {
                    $t->where('vendor_id', $vendor->id);
                });
            })->sum('total_price'),
        ];

        return view('vendor-panel.dashboard', compact('stats'));
    }

    public function tours()
    {
        $vendor = Auth::user()->vendor;
        $tours = Tour::where('vendor_id', $vendor->id)->with('category')->latest()->get();
        return view('vendor-panel.inventory', compact('tours'));
    }

    public function createTour()
    {
        $categories = Category::all();
        return view('vendor-panel.package-builder', compact('categories'));
    }

    public function storeTour(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'base_price' => 'required|numeric',
            'duration_days' => 'required|integer',
            'location' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|max:10240', // Increased to 10MB since we have browser-side compression
            'gallery_image_1' => 'nullable|image|max:10240',
            'gallery_image_2' => 'nullable|image|max:10240',
        ]);

        $vendor = Auth::user()->vendor;
        $imagePath = null;
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tours', 'public');
        }

        $tour = Tour::create([
            'vendor_id' => $vendor->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title . '-' . rand(100, 999)),
            'description' => $request->description,
            'base_price' => $request->base_price,
            'duration_days' => $request->duration_days,
            'location' => $request->location,
            'featured_image' => $imagePath,
            'max_guests' => 12, // Default
            'status' => 'active',
        ]);

        if ($request->hasFile('gallery_image_1')) {
            $path = $request->file('gallery_image_1')->store('tours', 'public');
            \App\Models\TourImage::create([
                'tour_id' => $tour->id,
                'image_path' => '/storage/' . $path,
                'is_featured' => false,
            ]);
        }

        if ($request->hasFile('gallery_image_2')) {
            $path = $request->file('gallery_image_2')->store('tours', 'public');
            \App\Models\TourImage::create([
                'tour_id' => $tour->id,
                'image_path' => '/storage/' . $path,
                'is_featured' => false,
            ]);
        }

        return redirect()->route('vendor.tours')->with('success', 'Tour package created successfully!');
    }

    public function editTour($id)
    {
        $tour = Tour::where('vendor_id', Auth::user()->vendor->id)->findOrFail($id);
        $categories = Category::all();
        return view('vendor-panel.package-builder', compact('categories', 'tour'));
    }

    public function updateTour(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'base_price' => 'required|numeric',
            'duration_days' => 'required|integer',
            'location' => 'required|string',
            'description' => 'required|string',
            'max_guests' => 'nullable|integer',
            'image' => 'nullable|image|max:10240',
            'gallery_image_1' => 'nullable|image|max:10240',
            'gallery_image_2' => 'nullable|image|max:10240',
        ]);

        $vendor = Auth::user()->vendor;
        $tour = Tour::where('vendor_id', $vendor->id)->findOrFail($id);

        $updateData = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'base_price' => $request->base_price,
            'duration_days' => $request->duration_days,
            'location' => $request->location,
            'max_guests' => $request->max_guests ?? 12,
        ];

        if ($request->hasFile('image')) {
            if ($tour->featured_image && Storage::disk('public')->exists($tour->featured_image)) {
                Storage::disk('public')->delete($tour->featured_image);
            }
            $updateData['featured_image'] = $request->file('image')->store('tours', 'public');
        }

        $tour->update($updateData);

        $galleryImages = \App\Models\TourImage::where('tour_id', $tour->id)
            ->where('is_featured', false)
            ->orderBy('id')
            ->get();
        
        $image1 = $galleryImages->get(0);
        $image2 = $galleryImages->get(1);

        if ($request->hasFile('gallery_image_1')) {
            $path = $request->file('gallery_image_1')->store('tours', 'public');
            if ($image1) {
                $relativePath = str_replace('/storage/', '', $image1->image_path);
                if (Storage::disk('public')->exists($relativePath)) {
                    Storage::disk('public')->delete($relativePath);
                }
                $image1->update(['image_path' => '/storage/' . $path]);
            } else {
                \App\Models\TourImage::create([
                    'tour_id' => $tour->id,
                    'image_path' => '/storage/' . $path,
                    'is_featured' => false,
                ]);
            }
        }

        if ($request->hasFile('gallery_image_2')) {
            $path = $request->file('gallery_image_2')->store('tours', 'public');
            if ($image2) {
                $relativePath = str_replace('/storage/', '', $image2->image_path);
                if (Storage::disk('public')->exists($relativePath)) {
                    Storage::disk('public')->delete($relativePath);
                }
                $image2->update(['image_path' => '/storage/' . $path]);
            } else {
                \App\Models\TourImage::create([
                    'tour_id' => $tour->id,
                    'image_path' => '/storage/' . $path,
                    'is_featured' => false,
                ]);
            }
        }

        return redirect()->route('vendor.tours')->with('success', 'Tour package updated successfully!');
    }

    public function bookings(Request $request)
    {
        $vendor = Auth::user()->vendor;
        $search = $request->input('search');

        $query = Booking::whereHas('departure', function($q) use ($vendor) {
            $q->whereHas('tour', function($t) use ($vendor) {
                $t->where('vendor_id', $vendor->id);
            });
        })->with(['departure.tour', 'user', 'travelers'])->latest();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('booking_number', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', function($u) use ($search) {
                      $u->where('name', 'LIKE', "%{$search}%");
                  });
            });
        }

        $bookings = $query->get();

        return view('vendor-panel.booking-tracker', compact('bookings'));
    }

    public function exportBookings()
    {
        $vendor = Auth::user()->vendor;
        $bookings = Booking::whereHas('departure', function($q) use ($vendor) {
            $q->whereHas('tour', function($t) use ($vendor) {
                $t->where('vendor_id', $vendor->id);
            });
        })->with(['departure.tour', 'user'])->latest()->get();

        $filename = "bookings_" . date('Y-m-d') . ".csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Booking ID', 'Customer', 'Tour', 'Travel Date', 'Price', 'Earning', 'Status', 'Date'];

        $callback = function() use($bookings, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($bookings as $booking) {
                fputcsv($file, [
                    $booking->booking_number,
                    $booking->user->name,
                    $booking->departure->tour->title,
                    $booking->departure->start_date,
                    $booking->total_price,
                    $booking->vendor_earning,
                    $booking->status,
                    $booking->created_at->format('Y-m-d')
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function showBooking($id)
    {
        $vendor = Auth::user()->vendor;
        $booking = Booking::whereHas('departure', function($q) use ($vendor) {
            $q->whereHas('tour', function($t) use ($vendor) {
                $t->where('vendor_id', $vendor->id);
            });
        })->with(['departure.tour', 'user', 'travelers'])->findOrFail($id);

        return view('vendor-panel.booking-details-modal', compact('booking'))->render();
    }

    public function confirmBooking($id)
    {
        $vendor = Auth::user()->vendor;
        $booking = Booking::whereHas('departure', function($q) use ($vendor) {
            $q->whereHas('tour', function($t) use ($vendor) {
                $t->where('vendor_id', $vendor->id);
            });
        })->findOrFail($id);

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Only pending bookings can be confirmed.');
        }

        DB::transaction(function () use ($booking) {
            $booking->update([
                'status' => 'confirmed',
                'payment_status' => 'paid'
            ]);

            // Decrement inventory
            $booking->departure->decrement('available_seats', $booking->guest_count);
        });

        return back()->with('success', 'Booking #' . $booking->booking_number . ' has been confirmed.');
    }

    public function cancelBooking($id)
    {
        $vendor = Auth::user()->vendor;
        $booking = Booking::whereHas('departure', function($q) use ($vendor) {
            $q->whereHas('tour', function($t) use ($vendor) {
                $t->where('vendor_id', $vendor->id);
            });
        })->findOrFail($id);

        if ($booking->status === 'cancelled') {
            return back()->with('error', 'Booking is already cancelled.');
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking #' . $booking->booking_number . ' has been cancelled.');
    }

    public function reviews()
    {
        $active = 'reviews';
        return view('vendor-panel.reviews', compact('active'));
    }

    public function profile()
    {
        $vendor = Auth::user()->vendor;
        return view('vendor-panel.profile', compact('vendor'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $vendor = $user->vendor;
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'agency_name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|max:2048',
        ]);

        // Update User
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->hasFile('avatar')) {
            $userData['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($userData);

        // Update Vendor Profile
        $vendor->update([
            'agency_name' => $request->agency_name,
            'bio' => $request->bio,
        ]);

        return back()->with('success', 'Profile and Agency details updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password changed successfully.');
    }
}
