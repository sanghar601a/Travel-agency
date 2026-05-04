@extends('layouts.app')

@section('title', $tour->title . ' - PAK TRAVEL')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-24">
    <!-- 1. Premium Gallery Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12 relative z-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
            <!-- Main Hero Image -->
            <div class="lg:col-span-8 h-[400px] md:h-[550px] relative overflow-hidden rounded-[2.5rem] shadow-2xl">
                <img src="{{ $tour->featuredImage() }}" 
                     class="w-full h-full object-cover" 
                     alt="{{ $tour->title }}"
                     onerror="this.src='https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=1200'">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent"></div>
                
                @php
                    $isInWishlist = auth()->check() && auth()->user()->wishlistedTours->contains($tour->id);
                @endphp
                <button onclick="toggleWishlist(this, {{ $tour->id }})" 
                        class="absolute top-8 right-8 w-14 h-14 rounded-2xl flex items-center justify-center transition-all shadow-lg z-30 {{ $isInWishlist ? 'bg-rose-500 text-white' : 'bg-white/20 backdrop-blur-md text-white hover:bg-white hover:text-rose-500' }}">
                    <i data-lucide="heart" class="w-6 h-6 {{ $isInWishlist ? 'fill-current' : '' }}"></i>
                </button>
            </div>
            
            <!-- Side Images -->
            <div class="hidden lg:grid lg:col-span-4 grid-rows-2 gap-4 h-[400px] md:h-[550px]">
                @foreach($tour->images->where('is_featured', false)->take(2) as $image)
                <div class="relative overflow-hidden rounded-[2rem] shadow-lg">
                    <img src="{{ Str::startsWith($image->image_path, 'http') ? $image->image_path : asset($image->image_path) }}" class="w-full h-full object-cover" alt="Gallery" onerror="this.style.display='none'">
                </div>
                @endforeach
                @if($tour->images->where('is_featured', false)->count() <= 1)
                    <div class="relative overflow-hidden rounded-[2rem] bg-slate-200 flex items-center justify-center">
                         <i data-lucide="image" class="w-12 h-12 text-slate-400"></i>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- 2. Main Layout Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- LEFT CONTENT (Title, Description, etc) -->
            <div class="lg:col-span-8 bg-white p-10 md:p-12 rounded-[3rem] shadow-sm border border-slate-100 relative z-30">
                <!-- Header Info -->
                <div class="mb-12">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="bg-blue-600 text-white text-[10px] font-black px-5 py-2 rounded-full uppercase tracking-widest">{{ $tour->category->name }}</span>
                        <div class="flex items-center gap-1 text-amber-500 font-black text-sm">
                            <i data-lucide="star" class="w-4 h-4 fill-amber-500"></i>
                            <span>{{ number_format($tour->rating ?? 4.9, 1) }}</span>
                        </div>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-black text-slate-900 mb-8 leading-tight tracking-tighter">{{ $tour->title }}</h1>
                    
                    <div class="flex flex-wrap items-center gap-10 py-8 border-y border-slate-50">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                                <i data-lucide="clock" class="w-5 h-5"></i>
                            </div>
                            <span class="font-bold text-slate-900">{{ $tour->duration_days }} Days</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600">
                                <i data-lucide="map-pin" class="w-5 h-5"></i>
                            </div>
                            <span class="font-bold text-slate-900">{{ $tour->location }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600">
                                <i data-lucide="users" class="w-5 h-5"></i>
                            </div>
                            <span class="font-bold text-slate-900">{{ $tour->max_guests }} People</span>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-16">
                    <h2 class="text-3xl font-black text-slate-900 mb-8 tracking-tight">Overview</h2>
                    <p class="text-slate-500 leading-relaxed text-xl font-medium">
                        {{ $tour->description }}
                    </p>
                </div>

                <!-- Journey -->
                <div>
                    <h2 class="text-3xl font-black text-slate-900 mb-10 tracking-tight">Trip Itinerary</h2>
                    <div class="space-y-8">
                        @forelse($tour->itineraries as $item)
                        <div class="relative pl-10 pb-2 border-l-2 border-slate-100">
                            <div class="absolute left-[-9px] top-0 w-4 h-4 rounded-full bg-blue-600"></div>
                            <div class="bg-slate-50 p-8 rounded-3xl">
                                <span class="text-blue-600 font-black text-[10px] uppercase tracking-widest block mb-2">Day {{ $item->day_number }}</span>
                                <h4 class="text-xl font-black text-slate-900 mb-3">{{ $item->title }}</h4>
                                <p class="text-slate-500 font-medium text-lg leading-relaxed">{{ $item->description }}</p>
                            </div>
                        </div>
                        @empty
                        @for($i = 1; $i <= $tour->duration_days; $i++)
                        <div class="relative pl-10 pb-2 border-l-2 border-slate-100">
                            <div class="absolute left-[-9px] top-0 w-4 h-4 rounded-full bg-blue-600"></div>
                            <div class="bg-slate-50 p-8 rounded-3xl">
                                <span class="text-blue-600 font-black text-[10px] uppercase tracking-widest block mb-2">Day {{ $i }}</span>
                                <h4 class="text-xl font-black text-slate-900 mb-3">Exploring {{ $tour->location }}</h4>
                                <p class="text-slate-500 font-medium leading-relaxed">Experience the best of the local culture and landscapes with our premium guided services.</p>
                            </div>
                        </div>
                        @endfor
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDEBAR (4/12) - STICKY CARD -->
            <div class="lg:col-span-4 lg:sticky lg:top-32 relative z-10">
                <div class="bg-white rounded-[3rem] p-10 shadow-2xl shadow-slate-900/10 border border-slate-100">
                    <div class="mb-10 pb-10 border-b border-slate-50">
                        <span class="text-slate-400 text-[11px] font-black uppercase tracking-widest block mb-4">Price Per Person</span>
                        <div class="flex items-baseline gap-2">
                            <span class="text-blue-600 text-2xl font-black italic">Rs.</span>
                            <span class="text-6xl font-black text-slate-900 tracking-tighter">{{ number_format($tour->base_price) }}</span>
                        </div>
                    </div>

                    <form action="{{ route('checkout') }}" method="GET" class="space-y-8">
                        <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                        
                        <div>
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-6">Available Dates</label>
                            <div class="space-y-4">
                                @forelse($tour->departures as $departure)
                                <label class="relative flex items-center p-5 bg-slate-50 rounded-2xl border-2 border-transparent cursor-pointer hover:border-blue-600 transition-all">
                                    <input type="radio" name="departure_id" value="{{ $departure->id }}" class="hidden peer" required>
                                    <div class="flex-1">
                                        <div class="font-black text-slate-900">{{ \Carbon\Carbon::parse($departure->start_date)->format('M d, Y') }}</div>
                                        <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest mt-1">{{ $departure->available_seats }} Seats Left</div>
                                    </div>
                                    <div class="w-6 h-6 border-2 border-slate-200 rounded-full peer-checked:bg-blue-600 peer-checked:border-blue-600 transition-all flex items-center justify-center">
                                        <i data-lucide="check" class="w-3 h-3 text-white"></i>
                                    </div>
                                </label>
                                @empty
                                <div class="p-8 bg-blue-50 rounded-3xl border border-dashed border-blue-200 text-center">
                                    <i data-lucide="calendar-off" class="w-8 h-8 text-blue-400 mx-auto mb-3"></i>
                                    <p class="text-xs font-bold text-blue-600 uppercase tracking-widest">Dates Coming Soon</p>
                                    <p class="text-[10px] text-blue-400 mt-2 font-medium">Join waitlist for updates</p>
                                </div>
                                @endforelse
                            </div>
                        </div>

                        @if($tour->departures->count() > 0)
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-4">Adults</label>
                                <select name="guests" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl font-black text-slate-900">
                                    <option value="1">01</option>
                                    <option value="2" selected>02</option>
                                    <option value="3">03</option>
                                    <option value="4">04</option>
                                    <option value="5">05</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-4">Kids</label>
                                <select class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl font-black text-slate-900">
                                    <option value="0">00</option>
                                    <option value="1">01</option>
                                    <option value="2">02</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-6 bg-blue-600 text-white rounded-3xl font-black text-xl shadow-xl shadow-blue-600/30 hover:bg-blue-700 transition-all uppercase tracking-widest">
                            Book Now
                        </button>
                        @else
                        <button type="button" disabled class="w-full py-6 bg-slate-100 text-slate-400 rounded-3xl font-black text-xl cursor-not-allowed uppercase tracking-widest">
                            Unavailable
                        </button>
                        @endif
                    </form>
                    
                    <div class="mt-8 flex items-center justify-center gap-4 text-slate-400 text-[10px] font-black uppercase tracking-widest">
                        <span class="flex items-center gap-2"><i data-lucide="shield-check" class="w-4 h-4 text-emerald-500"></i> Secure</span>
                        <div class="w-1 h-1 bg-slate-200 rounded-full"></div>
                        <span class="flex items-center gap-2"><i data-lucide="refresh-cw" class="w-4 h-4 text-blue-500"></i> Flexible</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
