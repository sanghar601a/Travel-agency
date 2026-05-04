<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Traveler Dashboard') - PAK TRAVEL</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon/paktravels-favicon.ico') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        body { font-family: 'Outfit', sans-serif; }
        .premium-shadow { box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.05); }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased">
    <div class="flex min-h-screen" x-data="{ 
        sidebarOpen: localStorage.getItem('travelerSidebarOpen') !== null ? localStorage.getItem('travelerSidebarOpen') === 'true' : window.innerWidth > 1024,
        mobileMenu: false,
        toggleSidebar() {
            if (window.innerWidth < 1024) {
                this.mobileMenu = !this.mobileMenu;
            } else {
                this.sidebarOpen = !this.sidebarOpen;
                localStorage.setItem('travelerSidebarOpen', this.sidebarOpen);
            }
        }
    }" @resize.window="if(window.innerWidth > 1024) mobileMenu = false">
        
        <!-- Mobile Backdrop -->
        <div x-show="mobileMenu" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="mobileMenu = false"
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[55] lg:hidden">
        </div>

        <!-- Premium Traveler Sidebar -->
        <aside :class="{ 
                    'w-80': sidebarOpen, 
                    'w-20': !sidebarOpen,
                    'translate-x-0': mobileMenu,
                    '-translate-x-full lg:translate-x-0': !mobileMenu 
                }"
               class="bg-[#0B1120] text-slate-400 flex flex-col fixed left-0 top-0 h-screen z-[60] border-r border-white/5 shadow-[20px_0_50px_rgba(0,0,0,0.3)] transition-all duration-300 ease-in-out group">
            
            <style>
                .custom-scrollbar::-webkit-scrollbar { width: 4px; }
                .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
                .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(59, 130, 246, 0.1); border-radius: 10px; }
                .custom-scrollbar:hover::-webkit-scrollbar-thumb { background: rgba(59, 130, 246, 0.3); }
            </style>

            <!-- Close Button (Mobile) -->
            <button @click="mobileMenu = false" class="lg:hidden absolute right-4 top-4 text-slate-400 hover:text-white transition-colors z-[70]">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>

            <!-- Branding Section -->
            <div class="flex-shrink-0 relative flex items-center justify-between transition-all duration-300"
                 :class="sidebarOpen ? 'p-8' : 'p-4 flex-col gap-4'">
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-blue-600/10 blur-[80px] rounded-full"></div>
                
                <a href="/" class="flex items-center gap-3 relative z-10 whitespace-nowrap overflow-hidden">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex-shrink-0 flex items-center justify-center text-white shadow-lg shadow-blue-500/20 rotate-3 transition-transform duration-500">
                        <i data-lucide="plane-takeoff" class="w-6 h-6"></i>
                    </div>
                    <div class="flex flex-col transition-all duration-300" :class="sidebarOpen ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-10 lg:hidden'">
                        <span class="text-2xl font-extrabold tracking-tighter text-white">
                            PAK<span class="bg-gradient-to-r from-blue-400 to-indigo-400 bg-clip-text text-transparent">TRAVEL</span>
                        </span>
                    </div>
                </a>

                <!-- Desktop Toggle (Integrated) -->
                <button @click="toggleSidebar()" 
                        class="hidden lg:flex relative z-20 w-8 h-8 rounded-xl bg-white/5 border border-white/10 items-center justify-center text-slate-400 hover:bg-blue-500 hover:text-white hover:border-blue-400 transition-all duration-300 shadow-lg">
                    <i data-lucide="chevron-left" class="w-4 h-4 transition-transform duration-500" :class="sidebarOpen ? '' : 'rotate-180'"></i>
                </button>
            </div>

            <nav class="flex-1 space-y-2 overflow-y-auto custom-scrollbar pt-4 overflow-x-hidden transition-all duration-300"
                 :class="sidebarOpen ? 'px-4' : 'px-2'">
                <div class="py-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-600 mb-2 whitespace-nowrap transition-all duration-300" 
                     :class="sidebarOpen ? 'px-6 opacity-100' : 'px-0 opacity-0 lg:hidden'">Main Menu</div>
                
                <a href="{{ route('dashboard') }}" class="group flex items-center rounded-[2rem] font-bold transition-all duration-500 relative {{ request()->routeIs('dashboard') ? 'text-white' : 'hover:text-white hover:bg-white/5' }}"
                   :class="sidebarOpen ? 'px-6 py-4 gap-4' : 'px-0 py-4 justify-center'">
                    @if(request()->routeIs('dashboard'))
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-transparent border-l-4 border-blue-500 rounded-r-3xl"></div>
                    @endif
                    <i data-lucide="layout-dashboard" class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('dashboard') ? 'text-blue-500' : 'group-hover:text-blue-400' }} transition-colors"></i>
                    <span class="relative z-10 transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 lg:hidden'">Overview</span>
                </a>

                <a href="{{ route('traveler.bookings') }}" class="group flex items-center rounded-[2rem] font-bold transition-all duration-500 relative {{ request()->routeIs('traveler.bookings') ? 'text-white' : 'hover:text-white hover:bg-white/5' }}"
                   :class="sidebarOpen ? 'px-6 py-4 gap-4' : 'px-0 py-4 justify-center'">
                    @if(request()->routeIs('traveler.bookings'))
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-transparent border-l-4 border-blue-500 rounded-r-3xl"></div>
                    @endif
                    <i data-lucide="briefcase" class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('traveler.bookings') ? 'text-blue-500' : 'group-hover:text-blue-400' }} transition-colors"></i>
                    <span class="relative z-10 transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 lg:hidden'">My Bookings</span>
                </a>

                <a href="{{ route('traveler.wishlist') }}" class="group flex items-center rounded-[2rem] font-bold transition-all duration-500 relative {{ request()->routeIs('traveler.wishlist') ? 'text-white' : 'hover:text-white hover:bg-white/5' }}"
                   :class="sidebarOpen ? 'px-6 py-4 gap-4' : 'px-0 py-4 justify-center'">
                    @if(request()->routeIs('traveler.wishlist'))
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-transparent border-l-4 border-blue-500 rounded-r-3xl"></div>
                    @endif
                    <i data-lucide="heart" class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('traveler.wishlist') ? 'text-blue-500' : 'group-hover:text-blue-400' }} transition-colors"></i>
                    <span class="relative z-10 transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 lg:hidden'">Wishlist</span>
                </a>

                <a href="{{ route('traveler.transactions') }}" class="group flex items-center rounded-[2rem] font-bold transition-all duration-500 relative {{ request()->routeIs('traveler.transactions') ? 'text-white' : 'hover:text-white hover:bg-white/5' }}"
                   :class="sidebarOpen ? 'px-6 py-4 gap-4' : 'px-0 py-4 justify-center'">
                    @if(request()->routeIs('traveler.transactions'))
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-transparent border-l-4 border-blue-500 rounded-r-3xl"></div>
                    @endif
                    <i data-lucide="credit-card" class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('traveler.transactions') ? 'text-blue-500' : 'group-hover:text-indigo-400' }} transition-colors"></i>
                    <span class="relative z-10 transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 lg:hidden'">Transactions</span>
                </a>

                <div class="py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-600 transition-all duration-300" 
                     :class="sidebarOpen ? 'px-6 opacity-100' : 'px-0 opacity-0 lg:hidden'">Preferences</div>

                <a href="{{ route('profile.edit') }}" class="group flex items-center rounded-[2rem] font-bold transition-all duration-500 relative {{ request()->routeIs('profile.edit') ? 'text-white' : 'hover:text-white hover:bg-white/5' }}"
                   :class="sidebarOpen ? 'px-6 py-4 gap-4' : 'px-0 py-4 justify-center'">
                    @if(request()->routeIs('profile.edit'))
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-transparent border-l-4 border-blue-500 rounded-r-3xl"></div>
                    @endif
                    <i data-lucide="settings" class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('profile.edit') ? 'text-blue-500' : 'group-hover:text-blue-400' }} transition-colors"></i>
                    <span class="relative z-10 transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 lg:hidden'">Settings</span>
                </a>
            </nav>

            <!-- User Section -->
            <div class="p-6 mt-auto">
                <a href="{{ route('profile.edit') }}" class="block bg-white/5 rounded-[2rem] border border-white/5 backdrop-blur-md hover:bg-white/10 transition-all duration-300 group/tprofile overflow-hidden" :class="sidebarOpen ? 'p-4' : 'p-2'">
                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=3b82f6&color=fff' }}" 
                         class="rounded-2xl border-2 border-blue-500 mx-auto mb-3 shadow-lg shadow-blue-500/20 object-cover group-hover:scale-105 transition-all duration-300" 
                         :class="sidebarOpen ? 'w-16 h-16' : 'w-10 h-10 mb-0'" alt="Avatar">
                    
                    <div class="text-center transition-all duration-300" :class="sidebarOpen ? 'opacity-100 h-auto' : 'opacity-0 h-0 lg:hidden'">
                        <div class="text-sm font-bold text-white truncate mb-1 group-hover:text-blue-400 transition-colors">{{ Auth::user()->name }}</div>
                        <div class="text-[9px] text-slate-500 uppercase tracking-widest font-black mb-4">Traveler Member</div>
                    </div>
                    
                    <form method="POST" action="{{ route('logout') }}" @click.stop x-show="sidebarOpen || window.innerWidth < 1024">
                        @csrf
                        <button type="submit" class="flex items-center justify-center gap-2 w-full py-3 bg-white/5 hover:bg-rose-500/10 text-slate-400 hover:text-rose-500 rounded-xl font-bold text-xs transition-all duration-300">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                            <span :class="sidebarOpen ? '' : 'lg:hidden'">Logout</span>
                        </button>
                    </form>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-h-screen transition-all duration-300"
              :class="{ 
                  'lg:ml-80': sidebarOpen, 
                  'lg:ml-20': !sidebarOpen,
                  'ml-0': true 
              }">
            <!-- Header -->
            <header class="h-24 bg-white border-b border-slate-100 flex items-center justify-between px-6 lg:px-10 sticky top-0 z-40">
                <div class="flex items-center gap-4">
                    <!-- Mobile Toggle -->
                    <button @click="toggleSidebar()" class="lg:hidden w-10 h-10 flex items-center justify-center bg-slate-50 text-slate-600 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>
                    <div>
                        <h2 class="text-lg lg:text-xl font-black text-slate-900 tracking-tight truncate max-w-[200px] lg:max-w-none">@yield('header_title', 'Welcome back, ' . explode(' ', Auth::user()->name)[0] . '!')</h2>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hidden sm:block">Traveler Dashboard</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4 lg:gap-6">
                    <button class="relative w-10 h-10 lg:w-12 lg:h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 hover:text-blue-600 transition-all">
                        <i data-lucide="bell" class="w-5 h-5 lg:w-6 lg:h-6"></i>
                        <span class="absolute top-2.5 right-2.5 lg:top-3 lg:right-3 w-2 h-2 lg:w-2.5 lg:h-2.5 bg-rose-500 rounded-full border-2 border-white"></span>
                    </button>
                    
                    <a href="/tours" class="px-4 py-2 lg:px-6 lg:py-3 bg-blue-600 text-white rounded-2xl font-bold text-xs lg:text-sm shadow-lg shadow-blue-600/20 hover:scale-105 transition-all whitespace-nowrap">
                        Book New Tour
                    </a>
                </div>
            </header>

            <div class="flex-1 p-6 lg:p-10 bg-slate-50/50">
                @yield('content')
            </div>
        </main>
    </div>

    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                },
                customClass: {
                    popup: 'rounded-[2rem]',
                }
            });
        });
    </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });

        function toggleWishlist(btn, tourId) {
            if (!tourId) return;

            fetch(`/wishlist/toggle/${tourId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (response.status === 401) {
                    Swal.fire({
                        title: 'Sign In Required',
                        text: "Please login to save tours to your wishlist.",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#2563eb',
                        cancelButtonColor: '#64748b',
                        confirmButtonText: 'Login Now'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/login';
                        }
                    });
                    return;
                }
                return response.json();
            })
            .then(data => {
                if (data && data.status === 'success') {
                    const icon = btn.querySelector('svg, i');
                    if (data.action === 'added') {
                        if(btn.classList.contains('bg-white/20')) {
                            btn.classList.remove('bg-white/20', 'backdrop-blur-md', 'opacity-0');
                            btn.classList.add('bg-rose-500', 'opacity-100');
                        }
                        icon.classList.add('fill-current');
                        
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            customClass: {
                                popup: 'rounded-2xl',
                            }
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'Added to Wishlist'
                        });
                    } else {
                        if(btn.classList.contains('bg-rose-500')) {
                            btn.classList.add('bg-white/20', 'backdrop-blur-md', 'opacity-0');
                            btn.classList.remove('bg-rose-500', 'opacity-100');
                        }
                        icon.classList.remove('fill-current');

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            customClass: {
                                popup: 'rounded-2xl',
                            }
                        });
                        Toast.fire({
                            icon: 'info',
                            title: 'Removed from Wishlist'
                        });
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
