@extends('layouts.vendor', ['active' => 'inventory'])

@section('header_title', 'Inventory & Availability')

@section('content')
<div class="space-y-10">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold text-slate-900">Manage Availability</h2>
            <p class="text-slate-500 mt-2">Control your tour departures and seat inventory.</p>
        </div>
        <button class="px-8 py-3 bg-blue-600 text-white rounded-2xl font-bold hover:bg-blue-700 transition-all premium-shadow flex items-center gap-2">
            <i data-lucide="plus" class="w-5 h-5"></i>
            Add Departure
        </button>
    </div>

    <!-- Calendar View Placeholder -->
    <div class="bg-white rounded-[2.5rem] p-10 premium-shadow border border-slate-50">
        <div class="flex items-center justify-between mb-10">
            <h3 class="text-xl font-bold text-slate-900">May 2026</h3>
            <div class="flex gap-2">
                <button class="w-10 h-10 rounded-xl border border-slate-100 flex items-center justify-center hover:bg-slate-50">
                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                </button>
                <button class="w-10 h-10 rounded-xl border border-slate-100 flex items-center justify-center hover:bg-slate-50">
                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </button>
            </div>
        </div>
        
        <div class="grid grid-cols-7 gap-4 text-center">
            @php $days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']; @endphp
            @foreach($days as $day)
                <div class="text-[10px] font-bold uppercase tracking-widest text-slate-400 pb-4">{{ $day }}</div>
            @endforeach

            @for($i = 1; $i <= 31; $i++)
                <div class="h-32 rounded-3xl border border-slate-50 p-4 relative group hover:border-blue-200 transition-all cursor-pointer {{ in_array($i, [12, 18, 25]) ? 'bg-blue-50/50 border-blue-100' : '' }}">
                    <span class="text-sm font-bold text-slate-900">{{ $i }}</span>
                    @if(in_array($i, [12, 18, 25]))
                        <div class="mt-2 space-y-1">
                            <div class="text-[8px] bg-blue-600 text-white px-2 py-0.5 rounded-full truncate">Skardu Adv...</div>
                            <div class="text-[8px] bg-emerald-600 text-white px-2 py-0.5 rounded-full truncate">8/12 Seats</div>
                        </div>
                    @endif
                </div>
            @endfor
        </div>
    </div>

    <div>
        <h3 class="text-2xl font-bold text-slate-900 mb-6">Your Tour Packages</h3>
        <div class="space-y-6">
            @forelse($tours as $tour)
            <div class="bg-white rounded-[2rem] p-8 premium-shadow border border-slate-50 flex flex-col md:flex-row items-center gap-8 relative overflow-hidden group hover:border-blue-100 transition-all">
                <!-- Left Accent Line -->
                <div class="absolute left-0 top-0 bottom-0 w-2 bg-gradient-to-b from-blue-500 to-indigo-600"></div>
                
                <div class="flex-1 w-full pl-2">
                    <div class="flex flex-wrap items-center gap-3 mb-3">
                        <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-bold uppercase tracking-widest rounded-full">{{ $tour->category->name }}</span>
                        <span class="px-3 py-1 {{ $tour->status == 'active' ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }} text-[10px] font-bold uppercase tracking-widest rounded-full">
                            {{ $tour->status }}
                        </span>
                    </div>
                    <h4 class="text-xl font-black text-slate-900 group-hover:text-blue-600 transition-colors mb-2">{{ $tour->title }}</h4>
                    <div class="text-sm font-medium text-slate-500 flex items-center gap-2">
                        <i data-lucide="map-pin" class="w-4 h-4 text-blue-500"></i>
                        {{ $tour->location }}
                    </div>
                </div>

                <!-- Dashed Divider -->
                <div class="hidden md:block w-px h-24 border-r-2 border-dashed border-slate-200"></div>

                <div class="flex gap-12 items-center w-full md:w-auto border-t md:border-t-0 border-slate-100 pt-6 md:pt-0 mt-4 md:mt-0">
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Duration</div>
                        <div class="text-lg font-black text-slate-900">{{ $tour->duration_days }} Days</div>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Base Price</div>
                        <div class="text-3xl font-black text-slate-900">${{ number_format($tour->base_price) }}</div>
                    </div>
                </div>
                
                <div class="w-full md:w-auto mt-4 md:mt-0 flex justify-end">
                    <a href="{{ route('vendor.packages.edit', $tour->id) }}" class="flex items-center gap-2 px-6 py-3 bg-slate-50 hover:bg-blue-600 text-slate-600 hover:text-white rounded-xl font-bold transition-all shadow-sm">
                        <i data-lucide="settings-2" class="w-4 h-4"></i>
                        Manage
                    </a>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-[2rem] p-12 text-center premium-shadow border border-slate-50">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="box" class="w-10 h-10 text-slate-300"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-900 mb-2">No packages found</h4>
                <p class="text-slate-500 mb-6 max-w-md mx-auto">You haven't created any tour packages yet. Start listing your premium experiences to attract travelers.</p>
                <a href="{{ route('vendor.packages.create') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-blue-600 text-white rounded-2xl font-bold hover:bg-blue-700 transition-all premium-shadow">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    Create First Package
                </a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
