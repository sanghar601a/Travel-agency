@extends('layouts.admin')

@section('title', 'Global Bookings - Admin Panel')
@section('header_title', 'Master Booking Tracker')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Global Bookings</h1>
            <p class="text-slate-500 font-medium">Monitor all transactions and trip reservations across the platform.</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="px-6 py-3 bg-white text-slate-900 rounded-2xl font-bold premium-shadow border border-slate-100 hover:bg-slate-50 transition-all flex items-center gap-2">
                <i data-lucide="download" class="w-4 h-4"></i>
                Export Report
            </button>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-[2.5rem] premium-shadow border border-slate-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600">
                    <i data-lucide="shopping-bag" class="w-6 h-6"></i>
                </div>
                <div>
                    <div class="text-2xl font-black text-slate-900">{{ $bookings->count() }}</div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Reservations</div>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-[2.5rem] premium-shadow border border-slate-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600">
                    <i data-lucide="badge-dollar-sign" class="w-6 h-6"></i>
                </div>
                <div>
                    <div class="text-2xl font-black text-slate-900">Rs. {{ number_format($bookings->sum('total_price')) }}</div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Gross Merchandise Value</div>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-[2.5rem] premium-shadow border border-slate-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600">
                    <i data-lucide="percent" class="w-6 h-6"></i>
                </div>
                <div>
                    <div class="text-2xl font-black text-slate-900">Rs. {{ number_format($bookings->sum('commission_amount')) }}</div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Platform Earnings</div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] premium-shadow border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
            <h3 class="font-bold text-slate-900 text-lg">Transaction History</h3>
            <div class="flex items-center gap-2">
                <div class="relative">
                    <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                    <input type="text" placeholder="Search reference..." class="pl-10 pr-4 py-2 bg-white border-transparent rounded-xl text-sm focus:ring-4 focus:ring-blue-600/5 transition-all outline-none border border-slate-100">
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                        <th class="px-8 py-5">Reference</th>
                        <th class="px-8 py-5">Traveler</th>
                        <th class="px-8 py-5">Tour / Vendor</th>
                        <th class="px-8 py-5">Status</th>
                        <th class="px-8 py-5 text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($bookings as $booking)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <td class="px-8 py-6">
                            <div class="font-bold text-slate-900">{{ $booking->booking_number }}</div>
                            <div class="text-[10px] text-slate-400 font-bold uppercase">{{ $booking->created_at->format('M d, Y') }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($booking->user->name) }}" class="w-8 h-8 rounded-lg" alt="">
                                <div>
                                    <div class="font-bold text-slate-900 text-sm">{{ $booking->user->name }}</div>
                                    <div class="text-[10px] text-slate-500 font-medium">{{ $booking->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="font-bold text-slate-900 text-sm">{{ $booking->departure->tour->title }}</div>
                            <div class="text-[10px] text-blue-600 font-bold uppercase tracking-widest">
                                By: {{ $booking->departure->tour->vendor->agency_name }}
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            @php
                                $statusClasses = [
                                    'confirmed' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                    'pending' => 'bg-amber-50 text-amber-600 border-amber-100',
                                    'cancelled' => 'bg-rose-50 text-rose-600 border-rose-100',
                                    'completed' => 'bg-blue-50 text-blue-600 border-blue-100',
                                ][$booking->status] ?? 'bg-slate-50 text-slate-600 border-slate-100';
                            @endphp
                            <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest border {{ $statusClasses }}">
                                {{ $booking->status }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="font-black text-slate-900">Rs. {{ number_format($booking->total_price) }}</div>
                            <div class="text-[10px] text-emerald-500 font-bold">Paid via Stripe</div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                                <i data-lucide="inbox" class="w-10 h-10"></i>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">No bookings found</h3>
                            <p class="text-slate-500">Wait for travelers to start booking tours.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
