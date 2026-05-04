<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\VendorRegisteredMail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:traveler,vendor'],
            'agency_name' => ['required_if:role,vendor', 'nullable', 'string', 'max:255'],
            'phone' => ['required', 'string'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->full_phone ?? $request->phone,
            'avatar' => $avatarPath,
        ]);

        // Create vendor profile if chosen
        if ($user->role === 'vendor') {
            $vendor = \App\Models\Vendor::create([
                'user_id' => $user->id,
                'agency_name' => $request->agency_name,
                'slug' => \Illuminate\Support\Str::slug($request->agency_name . ' ' . rand(100, 999)),
            ]);

            // Send Welcome Email
            try {
                Mail::to($user->email)->send(new VendorRegisteredMail($vendor));
            } catch (\Exception $e) {
                // Log error but continue
                \Log::error("Mail failed: " . $e->getMessage());
            }
        }

        event(new Registered($user));

        Auth::login($user);

        if ($user->isVendor()) {
            return redirect('/vendor/dashboard');
        }

        return redirect(route('dashboard', absolute: false));
    }
}
