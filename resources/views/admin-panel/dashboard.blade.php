@extends('layouts.admin', ['active' => 'dashboard'])

@section('header_title', 'System Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
    <!-- Total Revenue -->
    <div class="bg-white p-8 rounded-[2.5rem] enterprise-shadow border border-slate-50 relative overflow-hidden">
        <div class="flex items-center justify-between mb-4 relative z-10">
            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                <i data-lucide="line-chart" class="w-6 h-6"></i>
            </div>
        </div>
        <div class="relative z-10">
            <div class="text-3xl font-extrabold text-slate-900 mb-1">${{ number_format($stats['platform_revenue']) }}</div>
            <div class="text-sm font-bold text-slate-400 uppercase tracking-widest">Global GMV</div>
        </div>
        <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-indigo-500/5 rounded-full"></div>
    </div>

    <!-- Active Vendors -->
    <div class="bg-white p-8 rounded-[2.5rem] enterprise-shadow border border-slate-50 relative overflow-hidden">
        <div class="flex items-center justify-between mb-4 relative z-10">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
        </div>
        <div class="relative z-10">
            <div class="text-3xl font-extrabold text-slate-900 mb-1">{{ sprintf('%02d', $stats['total_vendors']) }}</div>
            <div class="text-sm font-bold text-slate-400 uppercase tracking-widest">Total Vendors</div>
        </div>
    </div>

    <!-- Active Tours -->
    <div class="bg-white p-8 rounded-[2.5rem] enterprise-shadow border border-slate-50 relative overflow-hidden">
        <div class="flex items-center justify-between mb-4 relative z-10">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                <i data-lucide="globe" class="w-6 h-6"></i>
            </div>
        </div>
        <div class="relative z-10">
            <div class="text-3xl font-extrabold text-slate-900 mb-1">{{ sprintf('%02d', $stats['active_tours']) }}</div>
            <div class="text-sm font-bold text-slate-400 uppercase tracking-widest">Active Tours</div>
        </div>
    </div>

    <!-- Total Bookings -->
    <div class="bg-white p-8 rounded-[2.5rem] enterprise-shadow border border-slate-50 relative overflow-hidden">
        <div class="flex items-center justify-between mb-4 relative z-10">
            <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center">
                <i data-lucide="shopping-bag" class="w-6 h-6"></i>
            </div>
        </div>
        <div class="relative z-10">
            <div class="text-3xl font-extrabold text-slate-900 mb-1">{{ sprintf('%02d', $stats['total_bookings']) }}</div>
            <div class="text-sm font-bold text-slate-400 uppercase tracking-widest">Total Bookings</div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Vendor Verification Queue -->
    <div class="lg:col-span-2 space-y-8">
        <div class="flex items-center justify-between">
            <h3 class="text-2xl font-bold text-slate-900">Verification Queue</h3>
            <a href="{{ route('admin.vendors') }}" class="text-sm font-bold text-indigo-600 hover:underline">Manage All Vendors</a>
        </div>

        <div class="bg-white rounded-[2.5rem] overflow-hidden enterprise-shadow border border-slate-50">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Agency Name</th>
                        <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Owner</th>
                        <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($pendingVendors as $vendor)
                    <tr class="hover:bg-slate-50/50 transition-all">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center font-bold">
                                    {{ substr($vendor->agency_name, 0, 2) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900">{{ $vendor->agency_name }}</div>
                                    <div class="text-xs text-slate-400">#V-{{ $vendor->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-sm font-medium text-slate-700">{{ $vendor->user->name }}</td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 bg-amber-50 text-amber-600 text-[10px] font-bold uppercase rounded-full tracking-wider">{{ $vendor->status }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <form action="{{ route('admin.vendors.status', $vendor->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="active">
                                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-[10px] font-bold uppercase rounded-lg hover:bg-indigo-700 transition-all">Approve</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-10 text-center text-slate-400 font-bold">
                            No pending verifications.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Platform Stats / Charts -->
    <div class="space-y-8">
        <h3 class="text-2xl font-bold text-slate-900">Category Distribution</h3>
        <div class="bg-white p-8 rounded-[2.5rem] enterprise-shadow border border-slate-50">
            <div class="space-y-6">
                <div>
                    <div class="flex justify-between text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">
                        <span>Adventure</span>
                        <span>42%</span>
                    </div>
                    <div class="w-full bg-slate-50 h-3 rounded-full overflow-hidden">
                        <div class="bg-indigo-600 h-full" style="width: 42%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">
                        <span>Religious</span>
                        <span>28%</span>
                    </div>
                    <div class="w-full bg-slate-50 h-3 rounded-full overflow-hidden">
                        <div class="bg-amber-500 h-full" style="width: 28%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">
                        <span>Honeymoon</span>
                        <span>15%</span>
                    </div>
                    <div class="w-full bg-slate-50 h-3 rounded-full overflow-hidden">
                        <div class="bg-rose-500 h-full" style="width: 15%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-indigo-900 rounded-[2.5rem] p-8 text-white relative overflow-hidden">
            <div class="relative z-10">
                <h4 class="text-xl font-bold mb-4">Commission Engine</h4>
                <p class="text-indigo-200 text-sm mb-6 leading-relaxed">Current global platform fee is set to 15% per booking.</p>
                <button class="w-full py-4 bg-white text-indigo-900 rounded-2xl font-bold hover:bg-indigo-50 transition-all">Configure Rates</button>
            </div>
            <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-white/5 rounded-full blur-2xl"></div>
        </div>
    </div>
</div>
@endsection
