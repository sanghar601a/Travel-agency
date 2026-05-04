@props([
    'title' => 'Majestic Heritage Tour',
    'location' => 'Agra, India',
    'price' => '1,299',
    'duration' => '7 Days',
    'rating' => '4.9',
    'image' => 'https://images.unsplash.com/photo-1548013146-72479768bada?auto=format&fit=crop&q=80&w=800',
    'badge' => 'Top Rated',
    'slug' => '',
    'id' => null
])

<div class="bg-white rounded-[3rem] overflow-hidden premium-shadow group hover:-translate-y-3 transition-all duration-700 border border-slate-50 relative">
    <!-- Image Section -->
    <div class="relative h-80 overflow-hidden">
        <img src="{{ $image }}" class="w-full h-full object-cover transition-transform duration-[2s] group-hover:scale-110" alt="{{ $title }}">
        
        <!-- Overlays -->
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent"></div>
        
        <div class="absolute top-6 left-6 flex flex-col gap-2">
            <span class="px-4 py-1.5 bg-blue-600 text-white text-[9px] font-black uppercase tracking-[0.2em] rounded-full shadow-lg">
                {{ $badge }}
            </span>
            <span class="px-4 py-1.5 bg-white/90 backdrop-blur-md text-slate-900 text-[9px] font-black uppercase tracking-[0.2em] rounded-full">
                {{ $duration }}
            </span>
        </div>

        @php
            $isInWishlist = $id && auth()->check() && auth()->user()->wishlistedTours->contains($id);
        @endphp
        <button onclick="event.preventDefault(); toggleWishlist(this, {{ $id ?? 0 }})" 
                class="absolute top-6 right-6 w-12 h-12 rounded-2xl flex items-center justify-center transition-all duration-300 shadow-lg z-20 {{ $isInWishlist ? 'bg-rose-500 text-white opacity-100' : 'bg-white/20 backdrop-blur-md text-white hover:bg-white hover:text-rose-500' }} {{ !$id ? 'hidden' : '' }}">
            <i data-lucide="heart" class="w-5 h-5 {{ $isInWishlist ? 'fill-current' : '' }}"></i>
        </button>

        <div class="absolute bottom-6 left-6 flex items-center gap-2 text-white/90">
            <i data-lucide="map-pin" class="w-4 h-4 text-blue-400"></i>
            <span class="text-sm font-bold tracking-tight">{{ $location }}</span>
        </div>
    </div>

    <!-- Content Section -->
    <div class="p-8">
        <div class="flex justify-between items-start mb-6">
            <h3 class="text-2xl font-black text-slate-900 leading-tight group-hover:text-blue-600 transition-colors">{{ $title }}</h3>
            <div class="flex items-center gap-1.5 bg-amber-50 text-amber-600 px-3 py-1.5 rounded-xl border border-amber-100">
                <i data-lucide="star" class="w-4 h-4 fill-amber-600"></i>
                <span class="text-xs font-black">{{ $rating }}</span>
            </div>
        </div>

        <div class="flex items-center justify-between pt-6 border-t border-slate-50">
            <div>
                <span class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] block mb-1">Starting from</span>
                <span class="text-3xl font-black text-slate-900">
                    <span class="text-blue-600 text-lg mr-1">Rs.</span>{{ $price }}
                </span>
            </div>
            <a href="{{ $slug ? url('/tour-detail/'.$slug) : route('tours') }}" class="w-14 h-14 bg-slate-900 text-white rounded-2xl flex items-center justify-center hover:bg-blue-600 hover:scale-110 transition-all duration-500 shadow-xl shadow-slate-900/10">
                <i data-lucide="arrow-right" class="w-6 h-6"></i>
            </a>
        </div>
    </div>
</div>
