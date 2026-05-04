<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Us | PAK TRAVEL</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon/paktravels-favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- International Phone Input -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/css/intlTelInput.css">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .premium-shadow { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08); }
        .iti { width: 100% !important; display: block !important; }
        .iti__country-list { border-radius: 1.5rem !important; border: none !important; box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important; padding: 10px !important; margin-top: 10px !important; }
        .iti__selected-dial-code { font-weight: 600; color: #1e293b; }
        .iti__selected-flag { border-radius: 1rem 0 0 1rem !important; padding-left: 15px !important; }
        [x-cloak] { display: none !important; }
        .form-input { 
            transition: all 0.3s ease;
            border: 1.5px solid #f1f5f9;
        }
        .form-input:focus {
            border-color: #4f46e5;
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }
    </style>
</head>
<body class="antialiased min-h-screen overflow-x-hidden">
    <div class="flex min-h-screen">
        <!-- Left Visual Side -->
        <div class="hidden lg:flex lg:w-5/12 relative overflow-hidden bg-slate-900 sticky top-0 h-screen">
            <img src="{{ asset('images/auth-bg.png') }}" class="absolute inset-0 w-full h-full object-cover opacity-60 transform scale-110" alt="Travel">
            <div class="absolute inset-0 bg-gradient-to-tr from-indigo-600/40 via-transparent to-transparent"></div>
            
            <div class="relative z-10 p-16 flex flex-col justify-between w-full">
                <a href="/" class="flex items-center gap-3 text-white">
                    <div class="w-12 h-12 bg-white/10 backdrop-blur-xl rounded-2xl flex items-center justify-center border border-white/20">
                        <i data-lucide="plane" class="w-6 h-6 text-white"></i>
                    </div>
                    <span class="text-2xl font-black tracking-tighter uppercase">Pak Travel</span>
                </a>

                <div class="animate__animated animate__fadeInUp">
                    <h1 class="text-6xl font-black text-white leading-tight mb-8 tracking-tighter">Elevate your <br> <span class="text-indigo-400">Travel Business.</span></h1>
                    <p class="text-slate-300 text-lg font-medium max-w-sm mb-12 leading-relaxed">Join the most premium travel marketplace in Pakistan and reach thousands of global travelers.</p>
                    
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-indigo-500/20 backdrop-blur-md rounded-xl flex items-center justify-center border border-indigo-400/20">
                                <i data-lucide="check" class="w-5 h-5 text-indigo-400"></i>
                            </div>
                            <span class="text-white font-semibold">Verified Partnerships</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-indigo-500/20 backdrop-blur-md rounded-xl flex items-center justify-center border border-indigo-400/20">
                                <i data-lucide="bar-chart-3" class="w-5 h-5 text-indigo-400"></i>
                            </div>
                            <span class="text-white font-semibold">Advanced Analytics</span>
                        </div>
                    </div>
                </div>

                <div class="text-slate-500 text-xs font-bold uppercase tracking-widest">
                    © 2026 Pak Travel Marketplaces
                </div>
            </div>
        </div>

        <!-- Right Form Side -->
        <div class="w-full lg:w-7/12 flex items-center justify-center p-8 md:p-16 bg-white relative">
            <!-- Decorative circle -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 opacity-50"></div>

            <div class="w-full max-w-2xl relative">
                <div class="mb-12">
                    <h2 class="text-4xl font-black text-slate-900 mb-2 tracking-tight">Create Account</h2>
                    <p class="text-slate-400 font-medium text-lg italic">Join the next generation of travelers.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-8" x-data="{ role: 'traveler', loading: false }" @submit="loading = true">
                    @csrf

                    <!-- Avatar Section -->
                    <div class="flex flex-col items-center justify-center mb-10">
                        <div x-data="{photoName: null, photoPreview: null}" class="relative group">
                            <input type="file" name="avatar" class="hidden" x-ref="photo" 
                                x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                                ">
                            <div class="w-32 h-32 rounded-[2.5rem] bg-slate-50 border-2 border-dashed border-slate-200 flex items-center justify-center overflow-hidden transition-all duration-500 group-hover:border-indigo-600 group-hover:bg-indigo-50/30 cursor-pointer" @click="$refs.photo.click()">
                                <template x-if="!photoPreview">
                                    <div class="text-center animate__animated animate__fadeIn">
                                        <i data-lucide="user-plus" class="w-8 h-8 text-slate-300 mx-auto mb-2 group-hover:text-indigo-600 transition-colors"></i>
                                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-indigo-600">Add Photo</span>
                                    </div>
                                </template>
                                <template x-if="photoPreview">
                                    <img :src="photoPreview" class="w-full h-full object-cover">
                                </template>
                            </div>
                            <button type="button" class="absolute -bottom-2 -right-2 w-10 h-10 bg-indigo-600 text-white rounded-2xl shadow-xl flex items-center justify-center hover:bg-slate-900 transition-all transform hover:rotate-90" @click="$refs.photo.click()">
                                <i data-lucide="camera" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Full Name -->
                        <div class="md:col-span-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Account Holder Name</label>
                            <div class="relative group">
                                <i data-lucide="user" class="absolute left-6 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-300 group-focus-within:text-indigo-600 transition-colors"></i>
                                <input type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full pl-16 pr-8 py-4.5 bg-slate-50 form-input rounded-3xl outline-none font-bold text-slate-900 placeholder:text-slate-300" placeholder="e.g. Muhammad Ahmed">
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2 ml-4" />
                        </div>

                        <!-- Email -->
                        <div class="group">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Email Address</label>
                            <div class="relative">
                                <i data-lucide="mail" class="absolute left-6 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-300 group-focus-within:text-indigo-600 transition-colors"></i>
                                <input type="email" name="email" value="{{ old('email') }}" required class="w-full pl-16 pr-8 py-4.5 bg-slate-50 form-input rounded-3xl outline-none font-bold text-slate-900 placeholder:text-slate-300" placeholder="ahmed@travel.com">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2 ml-4" />
                        </div>

                        <!-- Phone -->
                        <div class="group">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Phone Number</label>
                            <div class="relative">
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required class="w-full pl-16 pr-8 py-4.5 bg-slate-50 form-input rounded-3xl outline-none font-bold text-slate-900 placeholder:text-slate-300">
                            </div>
                            <x-input-error :messages="$errors->get('phone')" class="mt-2 ml-4" />
                        </div>

                        <!-- Role Selection -->
                        <div class="md:col-span-2">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1 text-center">I want to register as a...</label>
                            <div class="grid grid-cols-2 gap-6">
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="role" value="traveler" x-model="role" class="peer sr-only">
                                    <div class="p-6 bg-slate-50 border-2 border-transparent rounded-[2rem] peer-checked:border-indigo-600 peer-checked:bg-white peer-checked:shadow-2xl peer-checked:shadow-indigo-100 transition-all duration-300 text-center">
                                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform shadow-sm">
                                            <i data-lucide="compass" class="w-6 h-6 text-slate-300 peer-checked:text-indigo-600"></i>
                                        </div>
                                        <span class="block text-sm font-black text-slate-900 uppercase tracking-tighter">Explorer / Traveler</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="role" value="vendor" x-model="role" class="peer sr-only">
                                    <div class="p-6 bg-slate-50 border-2 border-transparent rounded-[2rem] peer-checked:border-indigo-600 peer-checked:bg-white peer-checked:shadow-2xl peer-checked:shadow-indigo-100 transition-all duration-300 text-center">
                                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform shadow-sm">
                                            <i data-lucide="briefcase" class="w-6 h-6 text-slate-300 peer-checked:text-indigo-600"></i>
                                        </div>
                                        <span class="block text-sm font-black text-slate-900 uppercase tracking-tighter">Service Provider</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Agency Name (Visible for Vendors) -->
                        <div class="md:col-span-2" x-show="role === 'vendor'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Travel Agency Name</label>
                            <div class="relative group">
                                <i data-lucide="building-2" class="absolute left-6 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-300 group-focus-within:text-indigo-600 transition-colors"></i>
                                <input type="text" name="agency_name" :required="role === 'vendor'" class="w-full pl-16 pr-8 py-4.5 bg-slate-50 form-input rounded-3xl outline-none font-bold text-slate-900 placeholder:text-slate-300" placeholder="e.g. Karakoram Nomads">
                            </div>
                            <x-input-error :messages="$errors->get('agency_name')" class="mt-2 ml-4" />
                        </div>

                        <!-- Password -->
                        <div class="group" x-data="{ show: false }">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Password</label>
                            <div class="relative">
                                <input :type="show ? 'text' : 'password'" name="password" required class="w-full pl-8 pr-16 py-4.5 bg-slate-50 form-input rounded-3xl outline-none font-bold text-slate-900 text-sm placeholder:text-slate-300" placeholder="Create Secure Password">
                                <button type="button" @click="show = !show" class="absolute right-6 top-1/2 -translate-y-1/2 text-slate-300 hover:text-indigo-600 transition-colors">
                                    <i data-lucide="eye" x-show="!show" class="w-5 h-5"></i>
                                    <i data-lucide="eye-off" x-show="show" class="w-5 h-5" style="display: none;"></i>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2 ml-4" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="group" x-data="{ show: false }">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Repeat Password</label>
                            <div class="relative">
                                <input :type="show ? 'text' : 'password'" name="password_confirmation" required class="w-full pl-8 pr-16 py-4.5 bg-slate-50 form-input rounded-3xl outline-none font-bold text-slate-900 text-sm placeholder:text-slate-300" placeholder="Confirm Your Password">
                                <button type="button" @click="show = !show" class="absolute right-6 top-1/2 -translate-y-1/2 text-slate-300 hover:text-indigo-600 transition-colors">
                                    <i data-lucide="eye" x-show="!show" class="w-5 h-5"></i>
                                    <i data-lucide="eye-off" x-show="show" class="w-5 h-5" style="display: none;"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="pt-8">
                        <button type="submit" 
                            :disabled="loading"
                            class="w-full py-5 bg-slate-900 text-white rounded-[2rem] font-black text-lg uppercase tracking-widest hover:bg-indigo-600 hover:shadow-2xl hover:shadow-indigo-200 transition-all duration-500 transform hover:-translate-y-1 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-3">
                            <span x-show="!loading">Create Account</span>
                            <span x-show="loading" class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Processing...
                            </span>
                        </button>
                    </div>

                    <div class="text-center pt-6">
                        <p class="text-slate-400 font-bold">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="text-indigo-600 hover:text-slate-900 transition-colors ml-2 underline decoration-2 underline-offset-8">Sign In</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/intlTelInput.min.js"></script>
    <script>
        lucide.createIcons();
        
        const input = document.querySelector("#phone");
        const iti = window.intlTelInput(input, {
            initialCountry: "pk",
            separateDialCode: true,
            strictMode: true,
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/utils.js",
            autoPlaceholder: "aggressive",
        });

        // Robust length control
        const enforceLimit = () => {
            const placeholder = input.getAttribute('placeholder');
            if (placeholder) {
                const maxLen = placeholder.length;
                if (input.value.length > maxLen) {
                    input.value = input.value.slice(0, maxLen);
                }
            }
        };

        input.addEventListener('input', enforceLimit);
        input.addEventListener('countrychange', () => {
            input.value = ''; // Reset on country change for safety
            setTimeout(enforceLimit, 100);
        });

        // Prevent non-numeric characters
        input.addEventListener('keypress', function(e) {
            const charCode = (e.which) ? e.which : e.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                e.preventDefault();
            }
        });

        // Add hidden input for full phone number including dial code
        const form = document.querySelector('form');
        form.addEventListener('submit', function() {
            const fullNumber = iti.getNumber();
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'full_phone';
            hiddenInput.value = fullNumber;
            form.appendChild(hiddenInput);
        });
    </script>
</body>
</html>
