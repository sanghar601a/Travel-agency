@extends('layouts.vendor-auth')

@section('title', 'Application Pending - PAK TRAVEL')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6">
    <div class="max-w-2xl w-full bg-white rounded-[3rem] enterprise-shadow border border-slate-50 overflow-hidden relative">
        <!-- Decorative Background Elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-50/50 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-emerald-50/50 rounded-full translate-y-1/2 -translate-x-1/2 blur-3xl"></div>

        <div class="relative p-12 md:p-16 text-center">
            <!-- Animated Icon Section -->
            <div class="mb-10 relative inline-block">
                <div class="w-24 h-24 bg-indigo-600 rounded-3xl flex items-center justify-center mx-auto shadow-xl shadow-indigo-200 animate__animated animate__zoomIn">
                    <i data-lucide="clock" class="w-12 h-12 text-white animate-pulse"></i>
                </div>
                <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-emerald-500 rounded-2xl border-4 border-white flex items-center justify-center animate__animated animate__bounceIn animate__delay-1s">
                    <i data-lucide="check" class="w-5 h-5 text-white"></i>
                </div>
            </div>

            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 mb-6 tracking-tight">
                Welcome to the <span class="text-indigo-600">Family!</span>
            </h1>
            
            <p class="text-lg text-slate-500 mb-10 leading-relaxed max-w-lg mx-auto font-medium">
                We've received your application to become a partner. Our team is currently reviewing your details to ensure the best experience for our travelers.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 text-left">
                <div class="bg-slate-50 p-6 rounded-[2rem] border border-slate-100/50">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center mb-4 shadow-sm">
                        <i data-lucide="shield-check" class="w-5 h-5 text-indigo-600"></i>
                    </div>
                    <h4 class="font-bold text-slate-900 text-sm mb-1">Step 1</h4>
                    <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Verification</p>
                </div>
                <div class="bg-indigo-600 p-6 rounded-[2rem] shadow-xl shadow-indigo-100 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mb-4 backdrop-blur-md">
                        <i data-lucide="search" class="w-5 h-5 text-white"></i>
                    </div>
                    <h4 class="font-bold text-white text-sm mb-1">Step 2</h4>
                    <p class="text-[11px] text-white/70 font-bold uppercase tracking-wider">Reviewing</p>
                </div>
                <div class="bg-slate-50 p-6 rounded-[2rem] border border-slate-100/50 opacity-50">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center mb-4 shadow-sm">
                        <i data-lucide="layout-dashboard" class="w-5 h-5 text-slate-400"></i>
                    </div>
                    <h4 class="font-bold text-slate-900 text-sm mb-1">Step 3</h4>
                    <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Dashboard Access</p>
                </div>
            </div>

            <div class="bg-indigo-50/50 rounded-[2.5rem] p-8 border border-indigo-100/50 mb-10 flex flex-col md:flex-row items-center gap-6 text-left">
                <div class="w-12 h-12 bg-white rounded-full flex shrink-0 items-center justify-center shadow-sm">
                    <i data-lucide="info" class="w-6 h-6 text-indigo-600"></i>
                </div>
                <div>
                    <h5 class="font-bold text-slate-900 mb-1">Estimated Time: 24-48 Hours</h5>
                    <p class="text-sm text-slate-500 font-medium leading-relaxed">Once verified, you will receive an email notification and full access to your vendor dashboard.</p>
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}" class="px-8 py-4 bg-slate-900 text-white rounded-2xl font-bold hover:bg-indigo-600 transition-all transform hover:scale-105">
                    Return to Homepage
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full px-8 py-4 bg-white text-slate-400 border border-slate-100 rounded-2xl font-bold hover:bg-slate-50 transition-all">
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
