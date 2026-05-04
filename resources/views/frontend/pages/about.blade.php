@extends('layouts.app')

@section('title', 'About Our Legacy - PAK TRAVEL')

@section('content')
<div class="bg-white selection:bg-indigo-100 selection:text-indigo-900 overflow-hidden">
    <!-- Cinematic Hero Section -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0 scale-110 animate-slow-zoom">
            <img src="https://images.unsplash.com/photo-1548062005-e50d0639138c?auto=format&fit=crop&q=80&w=2000" class="w-full h-full object-cover" alt="Pakistan Landscape">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-900/80 via-slate-900/40 to-white"></div>
        </div>
        
        <div class="relative z-10 text-center px-6 max-w-5xl mx-auto pt-20">
            <div class="inline-flex items-center gap-3 px-4 py-2 bg-white/10 backdrop-blur-xl border border-white/20 rounded-full mb-8 animate__animated animate__fadeInDown">
                <span class="w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></span>
                <span class="text-[10px] font-black text-white uppercase tracking-[0.3em]">Established 2024</span>
            </div>
            <h1 class="text-6xl md:text-[10rem] font-black text-white tracking-tighter leading-[0.85] mb-12 animate__animated animate__fadeInUp">
                Beyond <br>
                <span class="text-indigo-400 italic">Ordinary</span>
            </h1>
            <p class="text-slate-200 text-lg md:text-2xl font-medium max-w-2xl mx-auto leading-relaxed animate__animated animate__fadeInUp animate__delay-1s">
                Pakistan's first ultra-luxury multi-vendor travel collective. Curating world-class journeys for the discerning global explorer.
            </p>
        </div>

        <div class="absolute bottom-12 left-1/2 -translate-x-1/2 flex flex-col items-center gap-4 animate-bounce">
            <span class="text-[10px] font-black text-white/40 uppercase tracking-[0.4em] rotate-90 mb-8">Scroll</span>
            <div class="w-px h-16 bg-gradient-to-b from-indigo-500 to-transparent"></div>
        </div>
    </section>

    <!-- Stats Bar -->
    <section class="relative z-20 -mt-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-white rounded-[3rem] p-8 md:p-16 enterprise-shadow grid grid-cols-2 md:grid-cols-4 gap-12 border border-slate-50">
                <div class="text-center md:border-r border-slate-100">
                    <div class="text-4xl md:text-5xl font-black text-slate-900 mb-2">12k+</div>
                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Global Travelers</div>
                </div>
                <div class="text-center md:border-r border-slate-100">
                    <div class="text-4xl md:text-5xl font-black text-indigo-600 mb-2">150+</div>
                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Luxury Partners</div>
                </div>
                <div class="text-center md:border-r border-slate-100">
                    <div class="text-4xl md:text-5xl font-black text-slate-900 mb-2">98%</div>
                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Satisfaction</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-black text-indigo-600 mb-2">24/7</div>
                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Concierge</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Storytelling Section -->
    <section class="py-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
                <div class="relative group">
                    <div class="absolute -inset-10 bg-indigo-500/5 rounded-[5rem] rotate-6 group-hover:rotate-3 transition-transform duration-700"></div>
                    <div class="relative rounded-[4rem] overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1527004013197-933c4bb611b3?auto=format&fit=crop&q=80&w=1200" class="w-full h-[600px] object-cover hover:scale-110 transition-transform duration-1000" alt="Mountain View">
                        <div class="absolute inset-0 bg-indigo-900/10"></div>
                    </div>
                    <div class="absolute -bottom-12 -right-12 w-64 h-64 bg-white p-8 rounded-[3rem] shadow-2xl border border-slate-50 hidden md:block">
                        <i data-lucide="quote" class="w-12 h-12 text-indigo-600 mb-4"></i>
                        <p class="text-slate-600 font-bold italic leading-relaxed">"We don't just sell tours; we engineer lifelong memories."</p>
                    </div>
                </div>
                <div>
                    <span class="text-indigo-600 font-black uppercase tracking-[0.4em] text-[10px] mb-6 block">Our Foundation</span>
                    <h2 class="text-5xl md:text-7xl font-black text-slate-900 mb-10 tracking-tighter leading-none">A New Standard <br>in Exploration.</h2>
                    <div class="space-y-6 text-slate-500 font-medium text-lg leading-relaxed">
                        <p>
                            PAK TRAVEL was born from a singular vision: to unlock Pakistan's hidden gems through the lens of luxury. We recognized that the world's most breathtaking landscapes deserved world-class hospitality.
                        </p>
                        <p>
                            By uniting the country's most elite tour operators, boutique hotels, and expert guides on a single, seamless platform, we've created a gateway where safety meets splendor, and tradition meets modern innovation.
                        </p>
                    </div>
                    <div class="mt-12 flex items-center gap-6">
                        <div class="flex -space-x-4">
                            @for($i=1; $i<=4; $i++)
                                <img src="https://i.pravatar.cc/100?u={{$i}}" class="w-14 h-14 rounded-2xl border-4 border-white shadow-lg object-cover" alt="Avatar">
                            @endfor
                        </div>
                        <div>
                            <div class="text-slate-900 font-black">Trusted by Thousands</div>
                            <div class="text-slate-400 text-xs font-bold uppercase tracking-widest">Global Community</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-32 bg-slate-50 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-[0.03] pointer-events-none">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 100 C 20 0 50 0 100 100" fill="none" stroke="currentColor" stroke-width="0.1"></path>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-24">
                <h2 class="text-5xl md:text-7xl font-black text-slate-900 tracking-tighter mb-6">The PakTravel Ethos</h2>
                <p class="text-slate-500 font-medium text-xl">Built on three pillars of excellence that define our marketplace.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Vetting -->
                <div class="group">
                    <div class="bg-white p-12 rounded-[4rem] border border-slate-100 hover:border-indigo-500/30 transition-all duration-500 hover:-translate-y-4 shadow-sm hover:shadow-2xl">
                        <div class="w-20 h-20 bg-indigo-50 rounded-[2rem] flex items-center justify-center text-indigo-600 mb-10 group-hover:bg-indigo-600 group-hover:text-white group-hover:rotate-6 transition-all duration-500">
                            <i data-lucide="shield-check" class="w-10 h-10"></i>
                        </div>
                        <h4 class="text-2xl font-black text-slate-900 mb-6">Rigorous Vetting</h4>
                        <p class="text-slate-500 font-medium leading-relaxed mb-8">Every vendor undergoes a 50-point audit covering safety, service quality, and ethical practices.</p>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3 text-xs font-bold text-slate-400">
                                <div class="w-1.5 h-1.5 bg-indigo-500 rounded-full"></div> Verified Licenses
                            </li>
                            <li class="flex items-center gap-3 text-xs font-bold text-slate-400">
                                <div class="w-1.5 h-1.5 bg-indigo-500 rounded-full"></div> Safety Protocols
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Seamless -->
                <div class="group">
                    <div class="bg-white p-12 rounded-[4rem] border border-slate-100 hover:border-indigo-500/30 transition-all duration-500 hover:-translate-y-4 shadow-sm hover:shadow-2xl">
                        <div class="w-20 h-20 bg-blue-50 rounded-[2rem] flex items-center justify-center text-blue-600 mb-10 group-hover:bg-blue-600 group-hover:text-white group-hover:-rotate-6 transition-all duration-500">
                            <i data-lucide="cursor-click" class="w-10 h-10"></i>
                        </div>
                        <h4 class="text-2xl font-black text-slate-900 mb-6">Seamless Flow</h4>
                        <p class="text-slate-500 font-medium leading-relaxed mb-8">From instant booking to automated itineraries, we handle the complexity so you can focus on the view.</p>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3 text-xs font-bold text-slate-400">
                                <div class="w-1.5 h-1.5 bg-blue-500 rounded-full"></div> One-Click Booking
                            </li>
                            <li class="flex items-center gap-3 text-xs font-bold text-slate-400">
                                <div class="w-1.5 h-1.5 bg-blue-500 rounded-full"></div> Real-time Support
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Impact -->
                <div class="group">
                    <div class="bg-white p-12 rounded-[4rem] border border-slate-100 hover:border-indigo-500/30 transition-all duration-500 hover:-translate-y-4 shadow-sm hover:shadow-2xl">
                        <div class="w-20 h-20 bg-emerald-50 rounded-[2rem] flex items-center justify-center text-emerald-600 mb-10 group-hover:bg-emerald-600 group-hover:text-white group-hover:scale-110 transition-all duration-500">
                            <i data-lucide="heart-handshake" class="w-10 h-10"></i>
                        </div>
                        <h4 class="text-2xl font-black text-slate-900 mb-6">Local Impact</h4>
                        <p class="text-slate-500 font-medium leading-relaxed mb-8">We empower local communities by ensuring a larger share of revenue stays with the people on the ground.</p>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3 text-xs font-bold text-slate-400">
                                <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></div> Community Grants
                            </li>
                            <li class="flex items-center gap-3 text-xs font-bold text-slate-400">
                                <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></div> Sustainable Travel
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-40 relative bg-slate-900 overflow-hidden">
        <img src="https://images.unsplash.com/photo-1549412121-72484cabc008?auto=format&fit=crop&q=80&w=2000" class="absolute inset-0 w-full h-full object-cover opacity-30" alt="Mountain Night">
        <div class="absolute inset-0 bg-indigo-900/40 backdrop-blur-sm"></div>
        
        <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-6xl md:text-8xl font-black text-white tracking-tighter mb-12">The World is Waiting.</h2>
            <div class="flex flex-wrap justify-center gap-8">
                <a href="/tours" class="px-16 py-6 bg-white text-slate-900 rounded-[2rem] font-black text-sm uppercase tracking-widest hover:bg-indigo-500 hover:text-white transition-all duration-500 shadow-2xl">Begin Exploration</a>
                <a href="/register" class="px-16 py-6 bg-white/10 backdrop-blur-xl border border-white/20 text-white rounded-[2rem] font-black text-sm uppercase tracking-widest hover:bg-white/20 transition-all duration-500">Become a Partner</a>
            </div>
        </div>
    </section>
</div>

<style>
    @keyframes slow-zoom {
        0% { transform: scale(1); }
        100% { transform: scale(1.1); }
    }
    .animate-slow-zoom {
        animation: slow-zoom 20s infinite alternate ease-in-out;
    }
</style>
@endsection

