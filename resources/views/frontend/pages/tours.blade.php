@extends('layouts.app')

@section('title', 'Explore Premium Tours - PAK TRAVEL')

@section('content')
<div class="bg-slate-50 min-h-screen pt-40 pb-24">
    <!-- Header Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
            <div>
                <h1 class="text-5xl md:text-7xl font-black text-slate-900 tracking-tighter leading-none mb-6">Explore Our <span class="text-blue-600 italic">Tours</span></h1>
                <p class="text-slate-500 font-bold text-lg max-w-2xl uppercase tracking-widest">Discover the hidden gems of Pakistan with our curated luxury packages.</p>
            </div>
            
            <!-- Sort Dropdown -->
            <form action="{{ route('tours') }}" method="GET" id="sortForm" class="shrink-0">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="category" value="{{ request('category') }}">
                <div class="relative group">
                    <select name="sort" onchange="this.form.submit()" class="appearance-none bg-white border border-slate-200 px-8 py-4 pr-12 rounded-2xl font-black text-slate-900 text-xs tracking-widest uppercase outline-none focus:ring-4 focus:ring-blue-600/10 cursor-pointer shadow-sm group-hover:shadow-lg transition-all">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                    </select>
                    <i data-lucide="chevron-down" class="absolute right-6 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none group-hover:text-blue-600 transition-colors"></i>
                </div>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- 1. Filters Sidebar (3/12) -->
            <aside class="lg:col-span-3 space-y-8">
                <!-- Search Box -->
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                    <h3 class="text-xs font-black text-slate-900 uppercase tracking-[0.2em] mb-6 px-2">Search</h3>
                    <form action="{{ route('tours') }}" method="GET" class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Where to go?" class="w-full pl-12 pr-6 py-4 bg-slate-50 border-none rounded-2xl font-bold text-slate-900 placeholder:text-slate-400 outline-none focus:ring-4 focus:ring-blue-600/10">
                        <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                    </form>
                </div>

                <!-- Category Filters -->
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                    <h3 class="text-xs font-black text-slate-900 uppercase tracking-[0.2em] mb-6 px-2">Categories</h3>
                    <div class="space-y-3">
                        <a href="{{ route('tours') }}" class="flex items-center justify-between p-4 {{ !request('category') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'bg-slate-50 text-slate-600 hover:bg-slate-100' }} rounded-2xl transition-all">
                            <span class="font-black text-[10px] uppercase tracking-widest">All Packages</span>
                            <i data-lucide="chevron-right" class="w-4 h-4 opacity-50"></i>
                        </a>
                        @foreach($categories as $category)
                        <a href="{{ route('tours', ['category' => $category->id] + request()->except('category')) }}" class="flex items-center justify-between p-4 {{ request('category') == $category->id ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'bg-slate-50 text-slate-600 hover:bg-slate-100' }} rounded-2xl transition-all">
                            <span class="font-black text-[10px] uppercase tracking-widest">{{ $category->name }}</span>
                            <i data-lucide="chevron-right" class="w-4 h-4 opacity-50"></i>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Luxury Support Card -->
                <div class="bg-gradient-to-br from-slate-900 to-slate-800 p-8 rounded-[2.5rem] text-white overflow-hidden relative group">
                    <div class="relative z-10">
                        <h3 class="text-xl font-black mb-4 leading-tight">Need a Custom Tour?</h3>
                        <p class="text-slate-400 text-sm font-medium mb-8 leading-relaxed">Let our travel experts design a personalized luxury experience for you.</p>
                        <a href="#" class="inline-flex items-center gap-2 bg-blue-600 px-6 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-white hover:text-slate-900 transition-all">
                            Get in Touch <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                    <i data-lucide="phone-call" class="absolute -right-4 -bottom-4 w-32 h-32 text-white/5 -rotate-12 group-hover:scale-110 transition-transform"></i>
                </div>
            </aside>

            <!-- 2. Tours Grid (9/12) -->
            <main class="lg:col-span-9">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse($tours as $tour)
                    <div class="group relative bg-white rounded-[3rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-700 border border-slate-100 h-full flex flex-col">
                        <!-- Image Section -->
                        <div class="relative h-72 overflow-hidden">
                            <img src="{{ $tour->featuredImage() }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" alt="{{ $tour->title }}" onerror="this.src='https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=800'">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            
                            <div class="absolute top-6 left-6">
                                <span class="bg-white/95 backdrop-blur-md px-4 py-2 rounded-xl text-slate-900 text-[10px] font-black uppercase tracking-widest shadow-sm">
                                    {{ $tour->duration_days }} Days
                                </span>
                            </div>
                            
                            @php
                                $isInWishlist = auth()->check() && auth()->user()->wishlistedTours->contains($tour->id);
                            @endphp
                            <button onclick="toggleWishlist(this, {{ $tour->id }})" 
                                    class="absolute top-6 right-6 w-12 h-12 rounded-2xl flex items-center justify-center transition-all shadow-lg z-20 {{ $isInWishlist ? 'bg-rose-500 text-white opacity-100' : 'bg-white/20 backdrop-blur-md text-white hover:bg-white hover:text-rose-500 opacity-0 group-hover:opacity-100' }}">
                                <i data-lucide="heart" class="w-5 h-5 {{ $isInWishlist ? 'fill-current' : '' }}"></i>
                            </button>
                        </div>

                        <!-- Content Section -->
                        <div class="p-10 flex flex-col flex-1">
                            <div class="flex items-center gap-2 text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] mb-3">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-blue-600"></i>
                                {{ $tour->location }}
                            </div>
                            
                            <h3 class="text-2xl font-black text-slate-900 leading-tight mb-6 group-hover:text-blue-600 transition-colors flex-1">{{ $tour->title }}</h3>
                            
                            <div class="pt-8 border-t border-slate-50 flex items-end justify-between mt-auto">
                                <div>
                                    <span class="text-slate-400 text-[9px] font-black uppercase tracking-widest block mb-1">Starting from</span>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-blue-600 text-sm font-black italic">Rs.</span>
                                        <span class="text-3xl font-black text-slate-900 tracking-tighter">{{ number_format($tour->base_price) }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('tour.show', $tour->slug) }}" class="px-8 py-4 bg-slate-900 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-blue-600 hover:scale-105 transition-all shadow-lg shadow-slate-900/10">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-24 bg-white rounded-[4rem] text-center border-2 border-dashed border-slate-100">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i data-lucide="search-x" class="w-10 h-10 text-slate-300"></i>
                        </div>
                        <h4 class="text-2xl font-black text-slate-900 mb-2">No tours found</h4>
                        <p class="text-slate-400 font-bold">Try adjusting your filters or search keywords.</p>
                        <a href="{{ route('tours') }}" class="inline-block mt-8 px-10 py-4 bg-blue-600 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-blue-600/20">Clear All Filters</a>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-16">
                    {{ $tours->links() }}
                </div>
            </main>
        </div>
    </div>
</div>
@endsection
