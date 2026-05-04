@extends('layouts.dashboard')

@section('title', 'My Bookings')
@section('header_title', 'Your Travel Adventures')

@section('content')
<div class="max-w-5xl mx-auto space-y-10">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-2">Booking History</h1>
            <p class="text-slate-500 font-medium italic">"Travel is the only thing you buy that makes you richer."</p>
        </div>
        <div class="flex items-center gap-2 px-6 py-3 bg-white rounded-2xl border border-slate-100 premium-shadow">
            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
            <span class="text-sm font-bold text-slate-600">{{ $bookings->count() }} Active Reservations</span>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8">
        @forelse($bookings as $booking)
        <div class="bg-white rounded-[2.5rem] premium-shadow border border-slate-100 overflow-hidden flex flex-col md:flex-row group hover:border-blue-400 transition-all duration-500">
            <!-- Left: Visual Side (The 'Ticket Stub') -->
            <div class="w-full md:w-80 h-64 md:h-auto relative overflow-hidden shrink-0">
                <img src="{{ $booking->departure->tour->featuredImage() }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-[2s]" alt="Tour">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent"></div>
                
                <div class="absolute bottom-6 left-6 right-6">
                    <div class="flex items-center gap-2 text-white/70 text-[10px] font-black uppercase tracking-[0.2em] mb-2">
                        <i data-lucide="map-pin" class="w-3 h-3"></i>
                        {{ $booking->departure->tour->location }}
                    </div>
                    <h4 class="text-xl font-bold text-white leading-tight">{{ $booking->departure->tour->title }}</h4>
                </div>

                <!-- Status Badge Overlay -->
                @php
                    $statusColors = [
                        'confirmed' => 'from-emerald-500 to-teal-600',
                        'pending' => 'from-amber-500 to-orange-600',
                        'cancelled' => 'from-rose-500 to-pink-600',
                        'completed' => 'from-blue-500 to-indigo-600',
                    ][$booking->status] ?? 'from-slate-500 to-slate-600';
                @endphp
                <div class="absolute top-6 left-6">
                    <span class="px-4 py-1.5 bg-gradient-to-r {{ $statusColors }} text-white text-[9px] font-black uppercase tracking-[0.2em] rounded-full shadow-lg">
                        {{ $booking->status }}
                    </span>
                </div>
            </div>

            <!-- Right: Content Side (The 'Ticket Body') -->
            <div class="flex-1 p-8 md:p-10 flex flex-col justify-between relative bg-white">
                <!-- Perforation Design Effect -->
                <div class="hidden md:block absolute -left-4 top-10 bottom-10 w-8 flex flex-col justify-between items-center py-4 z-10">
                    @for($i=0; $i<8; $i++)
                        <div class="w-2 h-2 bg-slate-50 rounded-full border border-slate-100"></div>
                    @endfor
                </div>

                <div class="flex flex-col md:flex-row justify-between gap-6 mb-8">
                    <div class="space-y-4">
                        <div class="flex items-center gap-6">
                            <div>
                                <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Departure Date</div>
                                <div class="text-lg font-bold text-slate-900">{{ \Carbon\Carbon::parse($booking->departure->start_date)->format('D, M d, Y') }}</div>
                            </div>
                            <div class="h-10 w-px bg-slate-100"></div>
                            <div>
                                <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Travelers</div>
                                <div class="text-lg font-bold text-slate-900">{{ sprintf('%02d', $booking->guest_count) }} Adult(s)</div>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4 py-4 px-6 bg-slate-50 rounded-2xl border border-slate-100 w-fit">
                            <div class="flex items-center gap-2">
                                <i data-lucide="clock" class="w-4 h-4 text-blue-600"></i>
                                <span class="text-sm font-bold text-slate-700">{{ $booking->departure->tour->duration_days }} Days Trip</span>
                            </div>
                            <div class="w-1.5 h-1.5 bg-slate-300 rounded-full"></div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="shield-check" class="w-4 h-4 text-emerald-600"></i>
                                <span class="text-sm font-bold text-slate-700">Protected Booking</span>
                            </div>
                        </div>
                    </div>

                    <div class="text-right flex flex-col justify-center items-end">
                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Booking Total</div>
                        <div class="text-3xl font-black text-slate-900">Rs. {{ number_format($booking->total_price) }}</div>
                        <div class="flex items-center gap-2 mt-2">
                            @php
                                $pmIcons = ['stripe' => 'credit-card', 'bank' => 'landmark', 'easypaisa' => 'wallet'];
                                $pmColors = ['stripe' => 'text-blue-600', 'bank' => 'text-emerald-600', 'easypaisa' => 'text-purple-600'];
                            @endphp
                            <i data-lucide="{{ $pmIcons[$booking->payment_method] ?? 'circle-dollar-sign' }}" class="w-3 h-3 {{ $pmColors[$booking->payment_method] ?? 'text-slate-400' }}"></i>
                            <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">{{ $booking->payment_method ?? 'Unknown' }}</span>
                        </div>
                        <div class="text-[10px] font-bold text-blue-600 uppercase tracking-widest mt-1">#{{ $booking->booking_number }}</div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-8 border-t border-slate-50">
                    <div class="flex -space-x-3">
                        @for($i=0; $i<3; $i++)
                            <img src="https://i.pravatar.cc/100?u={{ $booking->id + $i }}" class="w-8 h-8 rounded-full border-2 border-white" alt="Traveler">
                        @endfor
                        <div class="w-8 h-8 rounded-full border-2 border-white bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500">
                            +{{ max(0, $booking->guest_count - 3) }}
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('traveler.booking.show', $booking->id) }}" class="px-6 py-3 border border-slate-200 text-slate-600 rounded-2xl font-bold text-xs hover:bg-slate-50 transition-all flex items-center gap-2">
                            <i data-lucide="download" class="w-4 h-4"></i>
                            Invoice
                        </a>
                        <a href="{{ route('traveler.booking.show', $booking->id) }}" class="px-8 py-3 bg-slate-900 text-white rounded-2xl font-bold text-xs hover:bg-blue-600 transition-all shadow-xl shadow-slate-900/10 hover:shadow-blue-500/20 flex items-center gap-2">
                            Manage Booking
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-[3rem] p-24 text-center border-2 border-dashed border-slate-200">
            <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-8 text-slate-300">
                <i data-lucide="compass" class="w-12 h-12"></i>
            </div>
            <h3 class="text-3xl font-black text-slate-900 mb-4">No adventures found!</h3>
            <p class="text-slate-500 max-w-sm mx-auto mb-10 text-lg">Pakistan is calling. Start your journey by exploring our premium tour packages.</p>
            <a href="/tours" class="inline-flex items-center gap-4 px-12 py-5 bg-blue-600 text-white rounded-3xl font-black shadow-2xl shadow-blue-600/30 hover:scale-105 hover:bg-blue-700 transition-all">
                Find Your First Tour
                <i data-lucide="arrow-right" class="w-6 h-6"></i>
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection
