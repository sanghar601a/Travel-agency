@php
    $isHome = request()->is('/');
@endphp

<nav x-data="{ atTop: {{ $isHome ? 'true' : 'false' }}, mobileMenuOpen: false }" 
     @scroll.window="atTop = {{ $isHome ? '(window.pageYOffset > 50 ? false : true)' : 'false' }}"
     :class="{ 
        'bg-white shadow-2xl shadow-slate-900/10 py-4': !atTop, 
        'bg-transparent py-8': atTop && {{ $isHome ? 'true' : 'false' }},
        'bg-white/80 backdrop-blur-xl border-b border-slate-100 py-4': atTop && {{ $isHome ? 'false' : 'true' }}
     }"
     class="fixed top-0 left-0 right-0 w-full z-[100] transition-all duration-500 ease-in-out">
    
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div :class="{ 'bg-white/90 backdrop-blur-2xl rounded-[2.5rem] px-8 py-3 shadow-xl border border-slate-100': !atTop && {{ $isHome ? 'true' : 'false' }} }" 
             class="flex justify-between items-center transition-all duration-500">
            
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-blue-600/20 group-hover:scale-110 transition-transform duration-500">
                        <i data-lucide="plane-takeoff" class="w-7 h-7"></i>
                    </div>
                    <span :class="{ 'text-slate-900': !atTop || !{{ $isHome ? 'true' : 'false' }}, 'text-white': atTop && {{ $isHome ? 'true' : 'false' }} }" 
                          class="text-2xl font-black tracking-tighter transition-colors duration-500 uppercase">
                        PAK<span class="text-blue-600">TRAVEL</span>
                    </span>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center gap-10">
                <a href="/" :class="{ 'text-slate-600 hover:text-blue-600': !atTop || !{{ $isHome ? 'true' : 'false' }}, 'text-white/90 hover:text-white': atTop && {{ $isHome ? 'true' : 'false' }} }" class="text-xs font-black uppercase tracking-[0.2em] transition-colors">Home</a>
                <a href="/tours" :class="{ 'text-slate-600 hover:text-blue-600': !atTop || !{{ $isHome ? 'true' : 'false' }}, 'text-white/90 hover:text-white': atTop && {{ $isHome ? 'true' : 'false' }} }" class="text-xs font-black uppercase tracking-[0.2em] transition-colors">Explore</a>
                <a href="/tours" :class="{ 'text-slate-600 hover:text-blue-600': !atTop || !{{ $isHome ? 'true' : 'false' }}, 'text-white/90 hover:text-white': atTop && {{ $isHome ? 'true' : 'false' }} }" class="text-xs font-black uppercase tracking-[0.2em] transition-colors">Destinations</a>
                <a href="{{ route('about') }}" :class="{ 'text-slate-600 hover:text-blue-600': !atTop || !{{ $isHome ? 'true' : 'false' }}, 'text-white/90 hover:text-white': atTop && {{ $isHome ? 'true' : 'false' }} }" class="text-xs font-black uppercase tracking-[0.2em] transition-colors">About</a>
            </div>

            <!-- CTA Buttons -->
            <div class="hidden lg:flex items-center gap-4">
                @auth
                    <a href="/dashboard" class="px-8 py-3 bg-slate-900 text-white text-xs font-black uppercase tracking-[0.2em] rounded-2xl shadow-lg hover:bg-blue-600 hover:scale-105 transition-all">
                        Dashboard
                    </a>
                @else
                    <a href="/login" :class="{ 'text-slate-900 hover:text-blue-600': !atTop || !{{ $isHome ? 'true' : 'false' }}, 'text-white hover:text-blue-200': atTop && {{ $isHome ? 'true' : 'false' }} }" class="text-xs font-black uppercase tracking-[0.2em] transition-colors px-4">Login</a>
                    <a href="/register" class="px-8 py-3 bg-blue-600 text-white text-xs font-black uppercase tracking-[0.2em] rounded-2xl shadow-lg shadow-blue-600/20 hover:scale-105 transition-all">
                        Join Us
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="lg:hidden flex items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" :class="{ 'text-slate-900': !atTop || !{{ $isHome ? 'true' : 'false' }}, 'text-white': atTop && {{ $isHome ? 'true' : 'false' }} }" class="p-2 focus:outline-none">
                    <i data-lucide="menu" x-show="!mobileMenuOpen" class="w-8 h-8"></i>
                    <i data-lucide="x" x-show="mobileMenuOpen" class="w-8 h-8" x-cloak></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-10"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="lg:hidden absolute top-full left-0 right-0 bg-white border-b border-slate-100 p-8 space-y-6 shadow-2xl" x-cloak>
        <a href="/" class="block text-slate-900 font-black text-lg uppercase tracking-widest">Home</a>
        <a href="/tours" class="block text-slate-900 font-black text-lg uppercase tracking-widest">Explore Tours</a>
        <a href="/tours" class="block text-slate-900 font-black text-lg uppercase tracking-widest">Destinations</a>
        <hr class="border-slate-50">
        <div class="flex flex-col gap-4">
            <a href="/login" class="text-center py-4 text-slate-900 font-black border border-slate-100 rounded-2xl uppercase tracking-widest">LOGIN</a>
            <a href="/register" class="text-center py-4 bg-blue-600 text-white font-black rounded-2xl shadow-lg shadow-blue-600/20 uppercase tracking-widest">REGISTER NOW</a>
        </div>
    </div>
</nav>
