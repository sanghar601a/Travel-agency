@php
    $layout = 'layouts.dashboard'; // Default for traveler
    if(Auth::user()->role === 'vendor') $layout = 'layouts.vendor';
    if(Auth::user()->role === 'admin') $layout = 'layouts.admin';
@endphp

@extends($layout)

@section('title', 'Profile Settings')
@section('header_title', 'Account Preferences')

@section('content')
<div class="max-w-4xl mx-auto space-y-10 pb-20">
    <div class="flex flex-col md:flex-row items-center gap-8 bg-white p-10 rounded-[3rem] premium-shadow border border-slate-100 relative overflow-hidden">
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-blue-600/5 blur-[100px] rounded-full"></div>
        
        <div class="relative">
            <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . Auth::user()->name . '&size=200' }}" class="w-32 h-32 rounded-3xl border-4 border-white shadow-2xl shadow-blue-600/20 object-cover" alt="Avatar">
            <button class="absolute -bottom-2 -right-2 w-10 h-10 bg-blue-600 text-white rounded-xl flex items-center justify-center shadow-lg hover:scale-110 transition-all border-4 border-white">
                <i data-lucide="camera" class="w-4 h-4"></i>
            </button>
        </div>
        
        <div class="text-center md:text-left">
            <h1 class="text-3xl font-black text-slate-900 mb-1">{{ Auth::user()->name }}</h1>
            <p class="text-slate-500 font-medium mb-4">{{ Auth::user()->email }}</p>
            <div class="flex flex-wrap justify-center md:justify-start gap-3">
                <span class="px-4 py-1.5 bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-blue-100">
                    {{ ucfirst(Auth::user()->role) }} Account
                </span>
                <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-emerald-100">
                    Verified Member
                </span>
            </div>
        </div>
    </div>

    <!-- Update Information -->
    <div class="grid grid-cols-1 gap-10">
        <div class="bg-white p-10 rounded-[3rem] premium-shadow border border-slate-100">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center">
                    <i data-lucide="user" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-900">Personal Information</h3>
                    <p class="text-sm text-slate-400">Update your account's profile information and email address.</p>
                </div>
            </div>
            
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Update Password -->
        <div class="bg-white p-10 rounded-[3rem] premium-shadow border border-slate-100">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center">
                    <i data-lucide="lock" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-900">Security & Password</h3>
                    <p class="text-sm text-slate-400">Ensure your account is using a long, random password to stay secure.</p>
                </div>
            </div>
            
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete Account -->
        <div class="bg-rose-50/50 p-10 rounded-[3rem] border border-rose-100">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 bg-rose-100 text-rose-600 rounded-2xl flex items-center justify-center">
                    <i data-lucide="trash-2" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-rose-900">Danger Zone</h3>
                    <p class="text-sm text-rose-500/70">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                </div>
            </div>
            
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>

<style>
    /* Premium overrides for Breeze form inputs */
    input[type="text"], input[type="email"], input[type="password"] {
        width: 100% !important;
        padding: 0.875rem 1.5rem !important;
        background: #f8fafc !important;
        border: 1px solid transparent !important;
        border-radius: 1rem !important;
        font-weight: 500 !important;
        color: #0f172a !important;
        transition: all 0.3s !important;
    }
    input:focus {
        background: #fff !important;
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1) !important;
        outline: none !important;
    }
    button[type="submit"] {
        padding: 0.75rem 2rem !important;
        background: #0f172a !important;
        color: #fff !important;
        border-radius: 1rem !important;
        font-weight: 700 !important;
        font-size: 0.875rem !important;
        transition: all 0.3s !important;
        box-shadow: 0 10px 20px rgba(15, 23, 42, 0.1) !important;
    }
    button[type="submit"]:hover {
        background: #3b82f6 !important;
        box-shadow: 0 10px 20px rgba(59, 130, 246, 0.2) !important;
    }
</style>
@endsection
