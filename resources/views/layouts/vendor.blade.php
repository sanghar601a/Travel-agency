<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Vendor Dashboard - PAK TRAVEL')</title>
    
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
    <script src="https://cdn.jsdelivr.net/npm/browser-image-compression@2.0.2/dist/browser-image-compression.js"></script>

    <style>
        body { font-family: 'Outfit', sans-serif; }
        .premium-shadow { box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.05); }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">
    <div class="flex min-h-screen" x-data="{ 
        sidebarOpen: localStorage.getItem('vendorSidebarOpen') !== null ? localStorage.getItem('vendorSidebarOpen') === 'true' : window.innerWidth > 1024,
        mobileMenu: false,
        toggleSidebar() {
            if (window.innerWidth < 1024) {
                this.mobileMenu = !this.mobileMenu;
            } else {
                this.sidebarOpen = !this.sidebarOpen;
                localStorage.setItem('vendorSidebarOpen', this.sidebarOpen);
            }
        }
    }" @resize.window="if(window.innerWidth > 1024) mobileMenu = false">
        <!-- Sidebar -->
        <x-vendor.sidebar :active="$active ?? 'dashboard'" />

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
                <div class="flex items-center gap-4">
                    <!-- Mobile Toggle -->
                    <button @click="toggleSidebar()" class="lg:hidden w-10 h-10 flex items-center justify-center bg-slate-50 text-slate-600 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>
                    <h2 class="text-lg lg:text-xl font-bold text-slate-900 truncate">@yield('header_title', 'Vendor Overview')</h2>
                </div>
                
                <div class="flex items-center gap-6">
                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 text-slate-400 hover:text-rose-500 font-bold transition-all">
                            <i data-lucide="log-out" class="w-5 h-5"></i>
                            Logout
                        </button>
                    </form>

                    <div class="flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-600 rounded-full font-bold text-sm">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                        Verified Partner
                    </div>
                    
                    <button class="relative w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center text-slate-400 hover:text-blue-600 transition-all">
                        <i data-lucide="bell" class="w-6 h-6"></i>
                        <span class="absolute top-3 right-3 w-2.5 h-2.5 bg-rose-500 rounded-full border-2 border-white"></span>
                    </button>
                    
                    <a href="{{ route('vendor.profile') }}" class="flex items-center gap-4 pl-6 border-l border-slate-100 group">
                        <div class="text-right">
                            <div class="font-bold text-slate-900 group-hover:text-blue-600 transition-colors">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-slate-400">Agency Account</div>
                        </div>
                        <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=3b82f6&color=fff' }}" class="w-12 h-12 rounded-full border-2 border-blue-100 object-cover group-hover:scale-105 transition-transform" alt="Avatar">
                    </a>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-10">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();

        // SweetAlert2 Toast Configuration
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

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
                title: 'Validation Error',
                html: `<ul class="text-left text-sm font-medium">
                        @foreach($errors->all() as $error)
                            <li class="mb-1">❌ {{ $error }}</li>
                        @endforeach
                       </ul>`,
                showConfirmButton: true,
                confirmButtonColor: '#3b82f6',
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
