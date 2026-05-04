<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PAK TRAVEL</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon/paktravels-favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .premium-shadow {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body class="bg-slate-50 antialiased overflow-y-auto min-h-screen">
    <div class="flex min-h-screen">
        <!-- Left Side: Visual -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
            <img src="{{ asset('images/auth-bg.png') }}" class="absolute inset-0 w-full h-full object-cover transform scale-105 hover:scale-100 transition-transform duration-[10s]" alt="Travel">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent"></div>
            
            <div class="relative z-10 p-20 flex flex-col justify-between w-full">
                <a href="/" class="flex items-center gap-2 text-white group">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center group-hover:bg-blue-600 transition-all duration-500">
                        <i data-lucide="plane" class="w-6 h-6"></i>
                    </div>
                    <span class="text-2xl font-extrabold tracking-tighter">PAK TRAVEL</span>
                </a>

                <div class="max-w-md">
                    <h1 class="text-5xl font-bold text-white leading-tight mb-6">Explore the world with premium comfort.</h1>
                    <p class="text-slate-200 text-lg">Join thousands of travelers who trust PAK TRAVEL for their lifetime adventures.</p>
                </div>

                <div class="flex gap-8 text-white/60 text-sm font-medium">
                    <span>© 2026 PAK TRAVEL</span>
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 md:p-12 bg-white relative overflow-y-auto">
            <!-- Mobile Logo -->
            <div class="absolute top-6 left-6 lg:hidden">
                <a href="/" class="flex items-center gap-2 text-slate-900">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white">
                        <i data-lucide="plane" class="w-5 h-5"></i>
                    </div>
                    <span class="text-xl font-extrabold tracking-tighter">PAK TRAVEL</span>
                </a>
            </div>

            <div class="w-full max-w-md space-y-5 pt-12 lg:pt-0">
                <div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-1 leading-tight">Welcome Back</h2>
                    <p class="text-slate-500 text-sm font-medium">Enter your credentials to access your account.</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-2" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Email Address</label>
                        <div class="relative group">
                            <i data-lucide="mail" class="absolute left-5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 group-focus-within:text-blue-600 transition-colors"></i>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full pl-14 pr-6 py-3.5 bg-slate-50 border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-600/10 transition-all outline-none font-medium text-slate-900" placeholder="name@company.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div x-data="{ show: false }">
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-[10px] font-bold text-blue-600 uppercase tracking-widest hover:underline">Forgot?</a>
                            @endif
                        </div>
                        <div class="relative group">
                            <i data-lucide="lock" class="absolute left-5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 group-focus-within:text-blue-600 transition-colors"></i>
                            <input :type="show ? 'text' : 'password'" name="password" required class="w-full pl-14 pr-14 py-3.5 bg-slate-50 border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-600/10 transition-all outline-none font-medium text-slate-900" placeholder="••••••••">
                            <button type="button" @click="show = !show" class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-blue-600 transition-colors">
                                <i data-lucide="eye" x-show="!show" class="w-4 h-4"></i>
                                <i data-lucide="eye-off" x-show="show" class="w-4 h-4" style="display: none;"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div class="flex items-center">
                        <label class="relative flex items-center cursor-pointer">
                            <input type="checkbox" name="remember" class="peer sr-only">
                            <div class="w-5 h-5 bg-slate-100 border border-slate-200 rounded peer-checked:bg-blue-600 peer-checked:border-blue-600 transition-all"></div>
                            <i data-lucide="check" class="absolute left-1 top-1 w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                            <span class="ml-3 text-xs font-medium text-slate-600">Keep me logged in</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-slate-900 text-white rounded-2xl font-bold hover:bg-blue-600 transition-all duration-300 premium-shadow">
                        Sign In
                    </button>
                </form>

                <div class="relative py-1">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-100"></div>
                    </div>
                    <div class="relative flex justify-center text-xs">
                        <span class="px-4 bg-white text-slate-400 font-medium tracking-tight">New to PAK TRAVEL?</span>
                    </div>
                </div>

                <div class="pt-1">
                    <a href="{{ route('register') }}" class="block w-full py-3.5 border border-slate-200 text-slate-900 rounded-2xl font-bold text-center hover:bg-slate-50 hover:border-slate-300 transition-all duration-300">
                        Create Account
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
