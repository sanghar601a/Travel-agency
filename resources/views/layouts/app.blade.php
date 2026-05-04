<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="overflow-x-hidden">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PAK TRAVEL - Premium Multi-Vendor Marketplace')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon/paktravels-favicon.ico') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
        .accent-gradient { background: linear-gradient(135deg, #2563eb 0%, #10b981 100%); }
        .premium-shadow { box-shadow: 0 20px 50px -12px rgba(0, 0, 0, 0.1); }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="font-['Outfit'] antialiased text-slate-900 bg-white overflow-x-hidden flex flex-col min-h-screen">
    <div class="flex flex-col min-h-screen">
        <x-navbar />

        <main class="flex-grow overflow-x-hidden w-full">
            @yield('content')
        </main>

        <x-footer />
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
            console.log('Toggling wishlist for tour:', tourId);
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
