@extends('layouts.dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
    <!-- Stat 1 -->
    <div class="bg-white p-8 rounded-[2rem] premium-shadow border border-slate-50">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                <i data-lucide="briefcase" class="w-6 h-6"></i>
            </div>
        </div>
        <div class="text-3xl font-extrabold text-slate-900 mb-1">{{ sprintf('%02d', $stats['total_bookings']) }}</div>
        <div class="text-sm font-bold text-slate-400 uppercase tracking-widest">Total Bookings</div>
    </div>

    <!-- Stat 2 -->
    <div class="bg-white p-8 rounded-[2rem] premium-shadow border border-slate-50">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center">
                <i data-lucide="map" class="w-6 h-6"></i>
            </div>
        </div>
        <div class="text-3xl font-extrabold text-slate-900 mb-1">{{ sprintf('%02d', $stats['visited_places']) }}</div>
        <div class="text-sm font-bold text-slate-400 uppercase tracking-widest">Visited Places</div>
    </div>

    <!-- Stat 3 -->
    <div class="bg-white p-8 rounded-[2rem] premium-shadow border border-slate-50">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center">
                <i data-lucide="heart" class="w-6 h-6"></i>
            </div>
        </div>
        <div class="text-3xl font-extrabold text-slate-900 mb-1">{{ sprintf('%02d', $stats['saved_tours']) }}</div>
        <div class="text-sm font-bold text-slate-400 uppercase tracking-widest">Saved Tours</div>
    </div>

    <!-- Stat 4 -->
    <div class="bg-white p-8 rounded-[2rem] premium-shadow border border-slate-50">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                <i data-lucide="wallet" class="w-6 h-6"></i>
            </div>
        </div>
        <div class="text-3xl font-extrabold text-slate-900 mb-1">${{ number_format($stats['total_spent']) }}</div>
        <div class="text-sm font-bold text-slate-400 uppercase tracking-widest">Total Spent</div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Active Bookings -->
    <div class="lg:col-span-2 space-y-8">
        <div class="flex items-center justify-between">
            <h3 class="text-2xl font-bold text-slate-900">Your Adventures</h3>
            <a href="#" class="text-sm font-bold text-blue-600 hover:underline">View All</a>
        </div>

        <div class="space-y-6">
            @forelse($recentBookings as $booking)
            <!-- Booking Card -->
            <div class="bg-white rounded-[2.5rem] p-6 premium-shadow border border-slate-50 flex flex-col md:flex-row gap-6">
                <img src="{{ $booking->departure->tour->featuredImage() }}" class="w-full md:w-48 h-40 object-cover rounded-3xl" alt="Tour">
                <div class="flex-1">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <span class="text-xs font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full uppercase tracking-wider mb-2 inline-block">{{ $booking->status }}</span>
                            <h4 class="text-xl font-bold text-slate-900">{{ $booking->departure->tour->title }}</h4>
                        </div>
                        <div class="text-right">
                            <div class="text-lg font-extrabold text-slate-900">${{ number_format($booking->total_price) }}</div>
                            <div class="text-xs text-slate-400">Order #{{ $booking->booking_number }}</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 py-4 border-t border-slate-50">
                        <div>
                            <div class="text-[10px] uppercase font-bold text-slate-400">Date</div>
                            <div class="text-sm font-bold text-slate-700">{{ \Carbon\Carbon::parse($booking->departure->start_date)->format('M d, Y') }}</div>
                        </div>
                        <div>
                            <div class="text-[10px] uppercase font-bold text-slate-400">Duration</div>
                            <div class="text-sm font-bold text-slate-700">{{ $booking->departure->tour->duration_days }} Days</div>
                        </div>
                        <div>
                            <div class="text-[10px] uppercase font-bold text-slate-400">Travelers</div>
                            <div class="text-sm font-bold text-slate-700">{{ sprintf('%02d', $booking->guest_count) }} Person(s)</div>
                        </div>
                        <div class="flex items-center justify-end gap-2">
                            <button class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all" title="View Details">
                                <i data-lucide="external-link" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-[2.5rem] p-12 text-center border-2 border-dashed border-slate-200">
                <p class="text-slate-400 font-bold">No bookings found. Start your journey today!</p>
                <a href="/tours" class="mt-4 inline-block px-8 py-3 bg-blue-600 text-white rounded-2xl font-bold">Browse Tours</a>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Notifications / Profile Summary -->
    <div class="space-y-8">
        <h3 class="text-2xl font-bold text-slate-900">Recent Notifications</h3>
        <div class="bg-white rounded-[2.5rem] p-8 premium-shadow border border-slate-50 space-y-6">
            <div class="flex gap-4">
                <div class="w-10 h-10 shrink-0 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                    <i data-lucide="info" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-900">Your trip to Agra is in 15 days!</p>
                    <p class="text-xs text-slate-400 mt-1">Start packing your bags and check our guide.</p>
                </div>
            </div>

            <div class="flex gap-4">
                <div class="w-10 h-10 shrink-0 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-900">Payment Successful</p>
                    <p class="text-xs text-slate-400 mt-1">Receipt for #PT-8821 has been generated.</p>
                </div>
            </div>

            <div class="flex gap-4">
                <div class="w-10 h-10 shrink-0 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center">
                    <i data-lucide="gift" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-900">New Reward Earned</p>
                    <p class="text-xs text-slate-400 mt-1">You just earned 500 travel points!</p>
                </div>
            </div>

            <button class="w-full py-4 bg-slate-50 text-slate-600 font-bold rounded-2xl hover:bg-slate-100 transition-all text-sm">Clear All Notifications</button>
        </div>
    </div>
</div>
@endsection
