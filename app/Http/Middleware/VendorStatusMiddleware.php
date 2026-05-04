<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class VendorStatusMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'vendor') {
            $vendor = Auth::user()->vendor;
            
            // If the vendor is not active and trying to access anything other than the pending page
            if ((!$vendor || $vendor->status !== 'active') && !$request->routeIs('vendor.pending')) {
                // If they are rejected, we might still want to logout
                if ($vendor && $vendor->status === 'rejected') {
                    Auth::logout();
                    return redirect()->route('login')->withErrors(['email' => 'Your vendor account has been rejected. Please contact support.']);
                }

                // For pending or suspended, redirect to the professional pending page
                return redirect()->route('vendor.pending');
            }

            // If the vendor IS active and trying to access the pending page, send them to dashboard
            if ($vendor && $vendor->status === 'active' && $request->routeIs('vendor.pending')) {
                return redirect()->route('vendor.dashboard');
            }
        }

        return $next($request);
    }
}
