<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Super Admin Console - PAK TRAVEL')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon/paktravels-favicon.ico') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { font-family: 'Outfit', sans-serif; }
        .enterprise-shadow { box-shadow: 0 20px 50px -12px rgba(0, 0, 0, 0.1); }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">
    <div class="flex min-h-screen" x-data="{ 
        sidebarOpen: localStorage.getItem('sidebarOpen') !== null ? localStorage.getItem('sidebarOpen') === 'true' : window.innerWidth > 1024,
        mobileMenu: false,
        toggleSidebar() {
            if (window.innerWidth < 1024) {
                this.mobileMenu = !this.mobileMenu;
            } else {
                this.sidebarOpen = !this.sidebarOpen;
                localStorage.setItem('sidebarOpen', this.sidebarOpen);
            }
        }
    }" @resize.window="if(window.innerWidth > 1024) mobileMenu = false">
        <!-- Sidebar -->
        <x-admin.sidebar :active="$active ?? 'dashboard'" />

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

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-w-0 transition-all duration-300"
              :class="{ 
                  'lg:ml-80': sidebarOpen, 
                  'lg:ml-20': !sidebarOpen,
                  'ml-0': true 
              }">
            <!-- Header -->
            <header class="h-24 bg-white border-b border-slate-100 flex items-center justify-between px-6 lg:px-10 shrink-0 sticky top-0 z-30">
                <div class="flex items-center gap-4 lg:gap-6">
                    <!-- Mobile Toggle -->
                    <button @click="toggleSidebar()" class="lg:hidden w-10 h-10 flex items-center justify-center bg-slate-50 text-slate-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition-all">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>

                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-indigo-600 rounded-full animate-pulse"></span>
                        <h2 class="text-lg lg:text-xl font-bold text-slate-900 truncate">@yield('header_title', 'System Overview')</h2>
                    </div>
                </div>
                
                <div class="flex items-center gap-6" x-data="{ openNotifications: false }">
                    <!-- Notifications -->
                    <div class="relative">
                        <button @click="openNotifications = !openNotifications; if(openNotifications) markAsRead()" class="w-12 h-12 bg-slate-50 text-slate-400 rounded-2xl flex items-center justify-center hover:bg-indigo-50 hover:text-indigo-600 transition-all relative">
                            <i data-lucide="bell" class="w-5 h-5"></i>
                            @if($pendingVendorsCount > 0)
                                <span class="absolute -top-1 -right-1 w-5 h-5 bg-rose-500 text-white text-[10px] font-bold flex items-center justify-center rounded-full border-2 border-white animate-bounce">
                                    {{ $pendingVendorsCount }}
                                </span>
                            @endif
                        </button>

                        <!-- Notification Dropdown -->
                        <div x-show="openNotifications" 
                             @click.away="openNotifications = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-4"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="absolute right-0 mt-4 w-80 bg-white rounded-[2rem] enterprise-shadow border border-slate-50 overflow-hidden z-50">
                            <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                                <h3 class="font-bold text-slate-900">Notifications</h3>
                                <span class="px-2 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-bold rounded-lg uppercase tracking-wider">{{ $pendingVendorsCount }} New</span>
                            </div>
                            <div class="max-h-96 overflow-y-auto">
                                @forelse($latestPendingVendors as $vendor)
                                    <a href="{{ route('admin.vendors', ['search' => $vendor->agency_name]) }}" class="flex items-start gap-4 p-6 hover:bg-slate-50 transition-all border-b border-slate-50/50">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($vendor->agency_name) }}&background=F1F5F9&color=6366F1" class="w-10 h-10 rounded-xl" alt="Agency">
                                        <div>
                                            <div class="text-sm font-bold text-slate-900">New Vendor Request</div>
                                            <div class="text-xs text-slate-500 mt-1">{{ $vendor->agency_name }} is waiting for approval.</div>
                                            <div class="text-[10px] text-slate-400 mt-2 font-medium">{{ $vendor->created_at->diffForHumans() }}</div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="p-10 text-center">
                                        <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                            <i data-lucide="check-circle-2" class="w-8 h-8 text-slate-200"></i>
                                        </div>
                                        <p class="text-slate-400 text-sm font-medium">No new notifications</p>
                                    </div>
                                @endforelse
                            </div>
                            <a href="{{ route('admin.vendors', ['status' => 'pending']) }}" class="block p-4 text-center text-xs font-bold text-indigo-600 hover:bg-indigo-50 transition-all">View all pending vendors</a>
                        </div>
                    </div>

                    <div class="hidden md:flex items-center gap-2 px-4 py-2 bg-slate-50 text-slate-500 rounded-full text-xs font-bold">
                        <i data-lucide="cpu" class="w-4 h-4"></i>
                        Server Status: <span class="text-emerald-600">Optimal</span>
                    </div>

                    <a href="{{ route('admin.profile') }}" class="flex items-center gap-4 pl-6 border-l border-slate-100 group">
                        <div class="text-right">
                            <div class="font-extrabold text-slate-900 uppercase tracking-tighter group-hover:text-indigo-600 transition-colors">{{ auth()->user()->name }}</div>
                            <div class="text-[10px] text-slate-400 font-bold">Super Admin</div>
                        </div>
                        <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=4f46e5&color=fff' }}" class="w-12 h-12 rounded-2xl border-2 border-indigo-100 object-cover group-hover:scale-105 transition-transform" alt="Admin">
                    </a>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-10 bg-slate-50/50">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();

        function markAsRead() {
            fetch('{{ route('admin.vendors.mark-read') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                }
            });
        }

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
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
        @endif

        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: `<ul class="text-left text-sm font-medium">
                        @foreach($errors->all() as $error)
                            <li class="mb-1">❌ {{ $error }}</li>
                        @endforeach
                       </ul>`,
                showConfirmButton: true,
                confirmButtonColor: '#4F46E5',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                },
                customClass: {
                    popup: 'rounded-[2rem]',
                    confirmButton: 'rounded-xl px-6 py-3'
                }
            });
        @endif
    </script>
    @stack('scripts')
</body>
</html>
