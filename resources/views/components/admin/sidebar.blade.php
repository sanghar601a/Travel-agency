@props(['active' => 'dashboard'])

<aside 
    :class="{ 
        'w-80': sidebarOpen, 
        'w-20': !sidebarOpen,
        'translate-x-0': mobileMenu,
        '-translate-x-full lg:translate-x-0': !mobileMenu 
    }"
    class="bg-[#0F172A] text-slate-400 flex flex-col fixed left-0 top-0 h-screen z-[60] border-r border-indigo-500/10 shadow-[20px_0_50px_rgba(0,0,0,0.4)] transition-all duration-300 ease-in-out group">
    
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { 
            background: rgba(79, 70, 229, 0.1); 
            border-radius: 20px; 
        }
        .custom-scrollbar:hover::-webkit-scrollbar-thumb { background: rgba(79, 70, 229, 0.3); }
    </style>

    <!-- Close Button (Mobile) -->
    <button @click="mobileMenu = false" class="lg:hidden absolute right-4 top-4 text-slate-400 hover:text-white transition-colors z-[70]">
        <i data-lucide="x" class="w-6 h-6"></i>
    </button>

    <!-- Premium Admin Brand -->
    <div class="flex-shrink-0 relative overflow-hidden flex items-center justify-between transition-all duration-300"
         :class="sidebarOpen ? 'p-8' : 'p-4 flex-col gap-4'">
        <div class="absolute -top-10 -left-10 w-40 h-40 bg-indigo-600/10 blur-[80px] rounded-full"></div>
        
        <a href="/" class="flex items-center gap-4 relative z-10 whitespace-nowrap overflow-hidden">
            <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-violet-600 rounded-2xl flex-shrink-0 flex items-center justify-center text-white shadow-xl shadow-indigo-500/20 group-hover:scale-110 transition-transform duration-500">
                <i data-lucide="shield-check" class="w-7 h-7"></i>
            </div>
            <div class="flex flex-col transition-all duration-300" :class="sidebarOpen ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-10 lg:hidden'">
                <span class="text-2xl font-black tracking-tighter text-white leading-none">
                    PAK<span class="bg-gradient-to-r from-indigo-400 to-violet-400 bg-clip-text text-transparent">ADMIN</span>
                </span>
                <span class="text-[9px] text-slate-500 uppercase tracking-[0.3em] font-black mt-1">Enterprise Console</span>
            </div>
        </a>

        <!-- Desktop Toggle (Integrated) -->
        <button @click="toggleSidebar()" 
                class="hidden lg:flex relative z-20 w-8 h-8 rounded-xl bg-white/5 border border-white/10 items-center justify-center text-slate-400 hover:bg-indigo-500 hover:text-white hover:border-indigo-400 transition-all duration-300 shadow-lg"
                :class="sidebarOpen ? '' : ''">
            <i data-lucide="chevron-left" class="w-4 h-4 transition-transform duration-500" :class="sidebarOpen ? '' : 'rotate-180'"></i>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 space-y-2 overflow-y-auto custom-scrollbar pt-4 overflow-x-hidden transition-all duration-300"
         :class="sidebarOpen ? 'px-4' : 'px-2'">
        <div class="py-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-600 mb-2 whitespace-nowrap transition-all duration-300" 
             :class="sidebarOpen ? 'px-6 opacity-100' : 'px-0 opacity-0 lg:hidden'">Platform Control</div>
        
        <a href="{{ route('admin.dashboard') }}" class="group flex items-center rounded-[2rem] font-bold transition-all duration-500 relative {{ $active == 'dashboard' ? 'text-white' : 'hover:text-white hover:bg-white/5' }}"
           :class="sidebarOpen ? 'px-6 py-4 gap-4' : 'px-0 py-4 justify-center'">
            @if($active == 'dashboard')
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600/20 to-transparent border-l-4 border-indigo-500 rounded-r-3xl"></div>
            @endif
            <i data-lucide="layout-dashboard" class="w-5 h-5 flex-shrink-0 {{ $active == 'dashboard' ? 'text-indigo-400' : 'group-hover:text-indigo-400' }} transition-colors"></i>
            <span class="relative z-10 transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 lg:hidden'">Overview</span>
        </a>

        <a href="{{ route('admin.vendors') }}" class="group flex items-center rounded-[2rem] font-bold transition-all duration-500 relative {{ $active == 'vendors' ? 'text-white' : 'hover:text-white hover:bg-white/5' }}"
           :class="sidebarOpen ? 'px-6 py-4 gap-4' : 'px-0 py-4 justify-center'">
            @if($active == 'vendors')
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600/20 to-transparent border-l-4 border-indigo-500 rounded-r-3xl"></div>
            @endif
            <i data-lucide="users" class="w-5 h-5 flex-shrink-0 {{ $active == 'vendors' ? 'text-indigo-400' : 'group-hover:text-indigo-400' }} transition-colors"></i>
            <span class="relative z-10 transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 lg:hidden'">Vendor Management</span>
        </a>

        <a href="{{ route('admin.bookings') }}" class="group flex items-center rounded-[2rem] font-bold transition-all duration-500 relative {{ $active == 'bookings' ? 'text-white' : 'hover:text-white hover:bg-white/5' }}"
           :class="sidebarOpen ? 'px-6 py-4 gap-4' : 'px-0 py-4 justify-center'">
            @if($active == 'bookings')
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600/20 to-transparent border-l-4 border-indigo-500 rounded-r-3xl"></div>
            @endif
            <i data-lucide="globe" class="w-5 h-5 flex-shrink-0 {{ $active == 'bookings' ? 'text-indigo-400' : 'group-hover:text-indigo-400' }} transition-colors"></i>
            <span class="relative z-10 transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 lg:hidden'">Global Bookings</span>
        </a>

        <div class="py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-600 transition-all duration-300" 
             :class="sidebarOpen ? 'px-6 opacity-100' : 'px-0 opacity-0 lg:hidden'">Financial Operations</div>

        <a href="/admin/commissions" class="group flex items-center rounded-[2rem] font-bold transition-all duration-500 relative {{ $active == 'commissions' ? 'text-white' : 'hover:text-white hover:bg-white/5' }}"
           :class="sidebarOpen ? 'px-6 py-4 gap-4' : 'px-0 py-4 justify-center'">
            @if($active == 'commissions')
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600/20 to-transparent border-l-4 border-indigo-500 rounded-r-3xl"></div>
            @endif
            <i data-lucide="percent" class="w-5 h-5 flex-shrink-0 {{ $active == 'commissions' ? 'text-indigo-400' : 'group-hover:text-indigo-400' }} transition-colors"></i>
            <span class="relative z-10 transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 lg:hidden'">Commissions</span>
        </a>

        <a href="/admin/payouts" class="group flex items-center rounded-[2rem] font-bold transition-all duration-500 relative {{ $active == 'payouts' ? 'text-white' : 'hover:text-white hover:bg-white/5' }}"
           :class="sidebarOpen ? 'px-6 py-4 gap-4' : 'px-0 py-4 justify-center'">
            @if($active == 'payouts')
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600/20 to-transparent border-l-4 border-indigo-500 rounded-r-3xl"></div>
            @endif
            <i data-lucide="landmark" class="w-5 h-5 flex-shrink-0 {{ $active == 'payouts' ? 'text-indigo-400' : 'group-hover:text-indigo-400' }} transition-colors"></i>
            <span class="relative z-10 transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 lg:hidden'">Vendor Payouts</span>
        </a>

        <a href="{{ route('admin.profile') }}" class="group flex items-center rounded-[2rem] font-bold transition-all duration-500 relative {{ $active == 'profile' ? 'text-white' : 'hover:text-white hover:bg-white/5' }}"
           :class="sidebarOpen ? 'px-6 py-4 gap-4' : 'px-0 py-4 justify-center'">
            @if($active == 'profile')
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600/20 to-transparent border-l-4 border-indigo-500 rounded-r-3xl"></div>
            @endif
            <i data-lucide="user-cog" class="w-5 h-5 flex-shrink-0 {{ $active == 'profile' ? 'text-indigo-400' : 'group-hover:text-indigo-400' }} transition-colors"></i>
            <span class="relative z-10 transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 lg:hidden'">My Profile</span>
        </a>

        <a href="/admin/support" class="group flex items-center rounded-[2rem] font-bold transition-all duration-500 relative {{ $active == 'support' ? 'text-white' : 'hover:text-white hover:bg-white/5' }}"
           :class="sidebarOpen ? 'px-6 py-4 gap-4' : 'px-0 py-4 justify-center'">
            @if($active == 'support')
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600/20 to-transparent border-l-4 border-indigo-500 rounded-r-3xl"></div>
            @endif
            <i data-lucide="ticket" class="w-5 h-5 flex-shrink-0 {{ $active == 'support' ? 'text-indigo-400' : 'group-hover:text-indigo-400' }} transition-colors"></i>
            <span class="relative z-10 transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 lg:hidden'">Support Tickets</span>
        </a>
    </nav>

    <!-- Admin User Section -->
    <div class="p-6 mt-auto">
        <a href="{{ route('admin.profile') }}" class="block bg-indigo-500/5 rounded-[2rem] border border-indigo-500/10 backdrop-blur-md hover:bg-indigo-500/10 transition-all duration-300 group/profile overflow-hidden" :class="sidebarOpen ? 'p-4' : 'p-2'">
            <div class="flex items-center gap-3" :class="sidebarOpen ? 'mb-4' : ''">
                <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=4f46e5&color=fff' }}" class="w-10 h-10 rounded-xl object-cover border border-white/10 group-hover/profile:border-indigo-500/50 transition-colors flex-shrink-0" alt="Admin">
                <div class="flex-1 overflow-hidden transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 lg:hidden'">
                    <div class="text-sm font-bold text-white truncate group-hover/profile:text-indigo-400 transition-colors">{{ auth()->user()->name }}</div>
                    <div class="text-[10px] text-indigo-400 uppercase tracking-widest font-black">Super Admin</div>
                </div>
            </div>
            
            <form method="POST" action="{{ route('logout') }}" @click.stop x-show="sidebarOpen || window.innerWidth < 1024">
                @csrf
                <button type="submit" class="flex items-center justify-center gap-2 w-full py-3 bg-white/5 hover:bg-rose-500/10 text-slate-400 hover:text-rose-500 rounded-xl font-bold text-xs transition-all duration-300 whitespace-nowrap">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    <span :class="sidebarOpen ? '' : 'lg:hidden'">Exit Console</span>
                </button>
            </form>
        </a>
    </div>
</aside>
