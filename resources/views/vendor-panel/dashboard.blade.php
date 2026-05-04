@extends('layouts.vendor', ['active' => 'dashboard'])

@section('header_title', 'Vendor Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
    <!-- Revenue -->
    <x-ui.card padding="p-8">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                <i data-lucide="banknote" class="w-6 h-6"></i>
            </div>
        </div>
        <div class="text-3xl font-extrabold text-slate-900 mb-1">${{ number_format($stats['total_revenue']) }}</div>
        <div class="text-sm font-bold text-slate-400 uppercase tracking-widest">Total Revenue</div>
    </x-ui.card>

    <!-- Active Bookings -->
    <x-ui.card padding="p-8">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center">
                <i data-lucide="shopping-bag" class="w-6 h-6"></i>
            </div>
        </div>
        <div class="text-3xl font-extrabold text-slate-900 mb-1">{{ sprintf('%02d', $stats['total_bookings']) }}</div>
        <div class="text-sm font-bold text-slate-400 uppercase tracking-widest">Active Bookings</div>
    </x-ui.card>

    <!-- Total Packages -->
    <x-ui.card padding="p-8">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center">
                <i data-lucide="package" class="w-6 h-6"></i>
            </div>
        </div>
        <div class="text-3xl font-extrabold text-slate-900 mb-1">{{ sprintf('%02d', $stats['active_tours']) }}</div>
        <div class="text-sm font-bold text-slate-400 uppercase tracking-widest">Active Packages</div>
    </x-ui.card>

    <!-- Average Rating -->
    <x-ui.card padding="p-8">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                <i data-lucide="star" class="w-6 h-6"></i>
            </div>
        </div>
        <div class="text-3xl font-extrabold text-slate-900 mb-1">5.0</div>
        <div class="text-sm font-bold text-slate-400 uppercase tracking-widest">Partner Rating</div>
    </x-ui.card>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Recent Bookings Table -->
    <div class="lg:col-span-2 space-y-8">
        <div class="flex items-center justify-between">
            <h3 class="text-2xl font-bold text-slate-900">Recent Bookings</h3>
            <a href="#" class="px-6 py-2 bg-slate-900 text-white rounded-xl font-bold text-sm hover:bg-blue-600 transition-all">View Tracker</a>
        </div>

        <div class="bg-white rounded-[2.5rem] overflow-hidden premium-shadow border border-slate-50">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Traveler</th>
                        <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Package</th>
                        <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Amount</th>
                        <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <!-- Row 1 -->
                    <tr class="hover:bg-slate-50/50 transition-all">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <img src="https://i.pravatar.cc/150?u=4" class="w-10 h-10 rounded-full" alt="User">
                                <div>
                                    <div class="font-bold text-slate-900">Zeeshan Ali</div>
                                    <div class="text-xs text-slate-400">#BK-9921</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-sm font-bold text-slate-700">Skardu Adventure</div>
                            <div class="text-xs text-slate-400">May 15 - May 25</div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-bold uppercase rounded-full tracking-wider">Confirmed</span>
                        </td>
                        <td class="px-8 py-6 font-bold text-slate-900">$1,450</td>
                        <td class="px-8 py-6 text-right">
                            <button class="w-8 h-8 flex items-center justify-center text-slate-400 hover:text-blue-600">
                                <i data-lucide="more-vertical" class="w-5 h-5"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- Row 2 -->
                    <tr class="hover:bg-slate-50/50 transition-all">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <img src="https://i.pravatar.cc/150?u=5" class="w-10 h-10 rounded-full" alt="User">
                                <div>
                                    <div class="font-bold text-slate-900">Sara Khan</div>
                                    <div class="text-xs text-slate-400">#BK-9922</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-sm font-bold text-slate-700">Umrah Premium</div>
                            <div class="text-xs text-slate-400">Jun 02 - Jun 15</div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 bg-amber-50 text-amber-600 text-[10px] font-bold uppercase rounded-full tracking-wider">Pending</span>
                        </td>
                        <td class="px-8 py-6 font-bold text-slate-900">$2,100</td>
                        <td class="px-8 py-6 text-right">
                            <button class="w-8 h-8 flex items-center justify-center text-slate-400 hover:text-blue-600">
                                <i data-lucide="more-vertical" class="w-5 h-5"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Analytics / Wallet Preview -->
    <div class="space-y-8">
        <h3 class="text-2xl font-bold text-slate-900">Wallet Preview</h3>
        <div class="bg-slate-900 rounded-[2.5rem] p-8 premium-shadow text-white relative overflow-hidden">
            <div class="relative z-10">
                <div class="flex justify-between items-start mb-10">
                    <div>
                        <div class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-2">Available Balance</div>
                        <div class="text-4xl font-extrabold">$12,850.00</div>
                    </div>
                    <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center">
                        <i data-lucide="credit-card" class="w-6 h-6"></i>
                    </div>
                </div>
                <div class="space-y-4 mb-8">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-400">Pending Settlement</span>
                        <span class="font-bold text-blue-400">+$2,400.00</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-400">Next Payout</span>
                        <span class="font-bold text-white">May 01, 2026</span>
                    </div>
                </div>
                <button class="w-full py-4 bg-blue-600 text-white rounded-2xl font-bold hover:bg-blue-700 transition-all premium-shadow">Request Payout</button>
            </div>
            <!-- Decorative circle -->
            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl"></div>
        </div>

        <h3 class="text-2xl font-bold text-slate-900 mt-10">Quick Actions</h3>
        <div class="grid grid-cols-2 gap-4">
            <a href="/vendor/packages" class="bg-white p-6 rounded-3xl border border-slate-50 premium-shadow flex flex-col items-center gap-3 hover:bg-blue-600 hover:text-white transition-all group">
                <i data-lucide="plus-circle" class="w-8 h-8 text-blue-600 group-hover:text-white"></i>
                <span class="font-bold text-sm text-center">Create Package</span>
            </a>
            <a href="/vendor/inventory" class="bg-white p-6 rounded-3xl border border-slate-50 premium-shadow flex flex-col items-center gap-3 hover:bg-blue-600 hover:text-white transition-all group">
                <i data-lucide="calendar" class="w-8 h-8 text-blue-600 group-hover:text-white"></i>
                <span class="font-bold text-sm text-center">Sync Calendar</span>
            </a>
        </div>
    </div>
</div>
@endsection
