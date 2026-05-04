<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;

// Public Routes
Route::get('/', function () {
    $tours = \App\Models\Tour::where('status', 'active')
        ->whereHas('vendor', function($q) {
            $q->where('status', 'active');
        })
        ->latest()->take(3)->get();
    return view('frontend.pages.home', compact('tours'));
})->name('home');

Route::get('/about', function () {
    return view('frontend.pages.about');
})->name('about');

Route::get('/tours', [TourController::class, 'index'])->name('tours');
Route::get('/tour-detail/{slug}', [TourController::class, 'show'])->name('tour.show');

// Authentication Required Routes
Route::middleware(['auth'])->group(function () {

    Route::get('/checkout', [BookingController::class, 'checkout'])->name('checkout');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

    // Unified Dashboard Redirector
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->role === 'vendor') {
            return redirect()->route('vendor.dashboard');
        }
        return redirect()->route('traveler.dashboard');
    })->name('dashboard');

    // Traveler Dashboard
    Route::middleware('role:traveler')->group(function () {
        Route::get('/traveler/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('traveler.dashboard');
        Route::get('/my-bookings', [App\Http\Controllers\DashboardController::class, 'bookings'])->name('traveler.bookings');
        Route::get('/wishlist', [App\Http\Controllers\DashboardController::class, 'wishlist'])->name('traveler.wishlist');
        Route::get('/booking/{id}', [App\Http\Controllers\BookingController::class, 'show'])->name('traveler.booking.show');
        Route::post('/booking/{id}/cancel', [App\Http\Controllers\BookingController::class, 'cancel'])->name('traveler.booking.cancel');
        Route::get('/transactions', [App\Http\Controllers\DashboardController::class, 'transactions'])->name('traveler.transactions');
        Route::post('/wishlist/toggle/{tour}', [App\Http\Controllers\Traveler\WishlistController::class, 'toggle'])->name('wishlist.toggle');
    });


    // Profile Management (Breeze Default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    // Vendor Panel Routes
    Route::prefix('vendor')->middleware(['role:vendor', 'vendor.active'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\VendorController::class, 'dashboard'])->name('vendor.dashboard');
        Route::get('/packages', [App\Http\Controllers\VendorController::class, 'createTour'])->name('vendor.packages.create');
        Route::post('/packages', [App\Http\Controllers\VendorController::class, 'storeTour'])->name('vendor.packages.store');
        Route::get('/packages/{id}/edit', [App\Http\Controllers\VendorController::class, 'editTour'])->name('vendor.packages.edit');
        Route::put('/packages/{id}', [App\Http\Controllers\VendorController::class, 'updateTour'])->name('vendor.packages.update');
        Route::get('/inventory', [App\Http\Controllers\VendorController::class, 'tours'])->name('vendor.tours');
        Route::get('/bookings', [App\Http\Controllers\VendorController::class, 'bookings'])->name('vendor.bookings');
        Route::get('/bookings/export', [App\Http\Controllers\VendorController::class, 'exportBookings'])->name('vendor.bookings.export');
        Route::get('/bookings/{id}', [App\Http\Controllers\VendorController::class, 'showBooking'])->name('vendor.bookings.show');
        Route::post('/bookings/{id}/confirm', [App\Http\Controllers\VendorController::class, 'confirmBooking'])->name('vendor.bookings.confirm');
        Route::post('/bookings/{id}/cancel', [App\Http\Controllers\VendorController::class, 'cancelBooking'])->name('vendor.bookings.cancel');
        Route::get('/reviews', [App\Http\Controllers\VendorController::class, 'reviews'])->name('vendor.reviews');
        Route::get('/wallet', function () {
            return view('vendor-panel.wallet');
        })->name('vendor.wallet');
        Route::get('/profile', [App\Http\Controllers\VendorController::class, 'profile'])->name('vendor.profile');
        Route::post('/profile/update', [App\Http\Controllers\VendorController::class, 'updateProfile'])->name('vendor.profile.update');
        Route::post('/profile/password', [App\Http\Controllers\VendorController::class, 'updatePassword'])->name('vendor.profile.password');

        Route::get('/pending-approval', function () {
            if (Auth::user()->vendor && Auth::user()->vendor->status === 'active') {
                return redirect()->route('vendor.dashboard');
            }
            return view('vendor-panel.pending');
        })->name('vendor.pending');
    });

    
    // Admin Panel Routes
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Admin Profile
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
        Route::post('/profile/password', [AdminController::class, 'updatePassword'])->name('admin.profile.password');

        // Vendor Status Management
        Route::get('/vendors', [AdminController::class, 'vendors'])->name('admin.vendors');
        Route::post('/vendors/mark-read', [App\Http\Controllers\AdminController::class, 'markNotificationsRead'])->name('admin.vendors.mark-read');
        Route::post('/vendors/{id}/status', [App\Http\Controllers\AdminController::class, 'updateVendorStatus'])->name('admin.vendors.status');
        Route::get('/bookings', [App\Http\Controllers\AdminController::class, 'bookings'])->name('admin.bookings');

        Route::get('/commissions', function () {
            return view('admin-panel.commissions');
        })->name('admin.commissions');
        Route::get('/payouts', [App\Http\Controllers\AdminController::class, 'payouts'])->name('admin.payouts');
        Route::get('/support', function () {
            return view('admin-panel.support');
        })->name('admin.support');
    });
});

require __DIR__.'/auth.php';
