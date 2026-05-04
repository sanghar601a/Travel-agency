@props(['active' => 'dashboard'])

<aside 
    :class="{ 
        'w-80': sidebarOpen, 
        'w-20': !sidebarOpen,
        'translate-x-0': mobileMenu,
        '-translate-x-full lg:translate-x-0': !mobileMenu 
    }"
    class="bg-[#0B1120] text-slate-400 flex flex-col fixed left-0 top-0 h-screen z-[60] border-r border-white/5 shadow-[20px_0_50px_rgba(0,0,0,0.3)] transition-all duration-300 ease-in-out group">
    
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { 
            background: rgba(59, 130, 246, 0.1); 
            border-radius: 20px; 
        }
        .custom-scrollbar:hover::-webkit-scrollbar-thumb { background: rgba(59, 130, 246, 0.3); }
    </style>

    <!-- Close Button (Mobile) -->
    <button @click="mobileMenu = false" class="lg:hidden absolute right-4 top-4 text-slate-400 hover:text-white transition-colors z-[70]">
        <i data-lucide="x" class="w-6 h-6"></i>
    </button>

    <!-- Premium Brand Section -->
    <div class="flex-shrink-0 relative flex items-center justify-between transition-all duration-300"
         :class="sidebarOpen ? 'p-8' : 'p-4 flex-col gap-4'">
        <div class="absolute -top-10 -left-10 w-40 h-40 bg-blue-600/10 blur-[80px] rounded-full"></div>
        
        <a href="/" class="flex items-center gap-3 relative z-10 whitespace-nowrap overflow-hidden">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex-shrink-0 flex items-center justify-center text-white shadow-lg shadow-blue-500/20 rotate-3 group-hover:rotate-0 transition-transform duration-500">
                <i data-lucide="plane-takeoff" class="w-6 h-6"></i>
            </div>
            <div class="flex flex-col transition-all duration-300" :class="sidebarOpen ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-10 lg:hidden'">
                <span class="text-2xl font-extrabold tracking-tighter text-white">
                    PAK<span class="bg-gradient-to-r from-blue-400 to-indigo-400 bg-clip-text text-transparent">VENDOR</span>
                </span>
            </div>
        </a>

        <!-- Desktop Toggle (Integrated) -->
        <button @click="toggleSidebar()" 
                class="hidden lg:flex relative z-20 w-8 h-8 rounded-xl bg-white/5 border border-white/10 items-center justify-center text-slate-400 hover:bg-blue-500 hover:text-white hover:border-blue-400 transition-all duration-300 shadow-lg"
                :class="sidebarOpen ? '' : ''">
            <i data-lucide="chevron-left" class="w-4 h-4 transition-transform duration-500" :class="sidebarOpen ? '' : 'rotate-180'"></i>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 space-y-2 overflow-y-auto custom-scrollbar pt-4 overflow-x-hidden transition-all duration-300"
         :class="sidebarOpen ? 'px-4' : 'px-2'">
        <div class="py-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-600 mb-2 whitespace-nowrap transition-all duration-300" 
             :class="sidebarOpen ? 'px-6 opacity-100' : 'px-0 opacity-0 lg:hidden'">Operations</div>
        
        <a href="{{ route('vendor.dashboard') }}" class="group flex items-center rounded-[2rem] font-bold transition-all duration-500 relative {{ $active == 'dashboard' ? 'text-white' : 'hover:text-white hover:bg-white/5' }}"
           :class="sidebarOpen ? 'px-6 py-4 gap-4' : 'px-0 py-4 justify-center'">
            @if($active == 'dashboard')
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-transparent border-l-4 border-blue-500 rounded-r-3xl"></div>
            @endif
            <i data-lucide="layout-dashboard" class="w-5 h-5 flex-shrink-0 {{ $active == 'dashboard' ? 'text-blue-500' : 'group-hover:text-blue-400' }} transition-colors"></i>
            <span class="relative z-10 transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 lg:hidden'">Dashboard</span>
        </a>

        <a href="{{ route('vendor.packages.create') }}" class="group flex items-center rounded-[2rem] font-bold transition-all duration-500 relative {{ $active == 'packages' ? 'text-white' : 'hover:text-white hover:bg-white/5' }}"
           :class="sidebarOpen ? 'px-6 py-4 gap-4' : 'px-0 py-4 justify-center'">
            @if($active == 'packages')
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-transparent border-l-4 border-blue-500 rounded-r-3xl"></div>
            @endif
            <i data-lucide="package" class="w-5 h-5 flex-shrink-0 {{ $active == 'packages' ? 'text-blue-500' : 'group-hover:text-blue-400' }} transition-colors"></i>
            <span class="relative z-10 transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 lg:hidden'">Package Builder</span>
        </a>

        <a href="{{ route('vendor.tours') }}" class="group flex items-center rounded-[2rem] font-bold transition-all duration-500 relative {{ $active == 'inventory' ? 'text-white' : 'hover:text-white hover:bg-white/5' }}"
           :class="sidebarOpen ? 'px-6 py-4 gap-4' : 'px-0 py-4 justify-center'">
            @if($active == 'inventory')
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-transparent border-l-4 border-blue-500 rounded-r-3xl"></div>
            @endif
            <i data-lucide="calendar-range" class="w-5 h-5 flex-shrink-0 {{ $active == 'inventory' ? 'text-blue-500' : 'group-hover:text-blue-400' }} transition-colors"></i>
            <span class="relative z-10 transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 lg:hidden'">Inventory</span>
        </a>

        <a href="{{ route('vendor.bookings') }}" class="group flex items-center rounded-[2rem] font-bold transition-all duration-500 relative {{ $active == 'bookings' ? 'text-white' : 'hover:text-white hover:bg-white/5' }}"
           :class="sidebarOpen ? 'px-6 py-4 gap-4' : 'px-0 py-4 justify-center'">
            @if($active == 'bookings')
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-transparent border-l-4 border-blue-500 rounded-r-3xl"></div>
            @endif
            <i data-lucide="shopping-bag" class="w-5 h-5 flex-shrink-0 {{ $active == 'bookings' ? 'text-blue-500' : 'group-hover:text-blue-400' }} transition-colors"></i>
            <span class="relative z-10 transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 lg:hidden'">Bookings</span>
            <span x-show="sidebarOpen" class="ml-auto bg-blue-500 text-white text-[10px] px-2 py-0.5 rounded-full shadow-lg shadow-blue-500/40 relative z-10">12</span>
        </a>

        <div class="py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-600 transition-all duration-300" 
             :class="sidebarOpen ? 'px-6 opacity-100' : 'px-0 opacity-0 lg:hidden'">Assets</div>

        <a href="{{ route('vendor.wallet') }}" class="group flex items-center rounded-[2rem] font-bold transition-all duration-500 relative {{ $active == 'wallet' ? 'text-white' : 'hover:text-white hover:bg-white/5' }}"
           :class="sidebarOpen ? 'px-6 py-4 gap-4' : 'px-0 py-4 justify-center'">
            @if($active == 'wallet')
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-transparent border-l-4 border-blue-500 rounded-r-3xl"></div>
            @endif
            <i data-lucide="wallet" class="w-5 h-5 flex-shrink-0 {{ $active == 'wallet' ? 'text-blue-500' : 'group-hover:text-blue-400' }} transition-colors"></i>
            <span class="relative z-10 transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 lg:hidden'">Wallet</span>
        </a>

        <a href="{{ route('vendor.reviews') }}" class="group flex items-center rounded-[2rem] font-bold transition-all duration-500 relative {{ $active == 'reviews' ? 'text-white' : 'hover:text-white hover:bg-white/5' }}"
           :class="sidebarOpen ? 'px-6 py-4 gap-4' : 'px-0 py-4 justify-center'">
            @if($active == 'reviews')
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-transparent border-l-4 border-blue-500 rounded-r-3xl"></div>
            @endif
            <i data-lucide="star" class="w-5 h-5 flex-shrink-0 {{ $active == 'reviews' ? 'text-blue-500' : 'group-hover:text-blue-400' }} transition-colors"></i>
            <span class="relative z-10 transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 lg:hidden'">Reviews</span>
        </a>

        <div class="py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-600 transition-all duration-300" 
             :class="sidebarOpen ? 'px-6 opacity-100' : 'px-0 opacity-0 lg:hidden'">Account</div>

        <a href="{{ route('vendor.profile') }}" class="group flex items-center rounded-[2rem] font-bold transition-all duration-500 relative {{ $active == 'profile' ? 'text-white' : 'hover:text-white hover:bg-white/5' }}"
           :class="sidebarOpen ? 'px-6 py-4 gap-4' : 'px-0 py-4 justify-center'">
            @if($active == 'profile')
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-transparent border-l-4 border-blue-500 rounded-r-3xl"></div>
            @endif
            <i data-lucide="user-check" class="w-5 h-5 flex-shrink-0 {{ $active == 'profile' ? 'text-blue-500' : 'group-hover:text-blue-400' }} transition-colors"></i>
            <span class="relative z-10 transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 lg:hidden'">Profile / KYC</span>
        </a>
    </nav>

    <!-- User Section -->
    <div class="p-6 mt-auto">
        <a href="{{ route('vendor.profile') }}" class="block bg-white/5 rounded-[2rem] border border-white/5 backdrop-blur-md hover:bg-white/10 transition-all duration-300 group/vprofile overflow-hidden" :class="sidebarOpen ? 'p-4' : 'p-2'">
            <div class="flex items-center gap-3" :class="sidebarOpen ? 'mb-4' : ''">
                <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=3b82f6&color=fff' }}" class="w-10 h-10 rounded-xl object-cover border border-white/10 group-hover/vprofile:border-blue-500/50 transition-colors flex-shrink-0" alt="Avatar">
                <div class="flex-1 overflow-hidden transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-10 lg:hidden'">
                    <div class="text-sm font-bold text-white truncate group-hover/vprofile:text-blue-400 transition-colors">{{ auth()->user()->name }}</div>
                    <div class="text-[10px] text-slate-500 uppercase tracking-widest font-black">Verified Partner</div>
                </div>
            </div>
            
            <form method="POST" action="{{ route('logout') }}" @click.stop x-show="sidebarOpen || window.innerWidth < 1024">
                @csrf
                <button type="submit" class="flex items-center justify-center gap-2 w-full py-3 bg-white/5 hover:bg-rose-500/10 text-slate-400 hover:text-rose-500 rounded-xl font-bold text-xs transition-all duration-300 whitespace-nowrap">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    <span :class="sidebarOpen ? '' : 'lg:hidden'">Sign Out</span>
                </button>
            </form>
        </a>
    </div>
</aside>
