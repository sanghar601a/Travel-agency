@extends('layouts.vendor', ['active' => 'wallet'])

@section('header_title', 'Financial Wallet')

@section('content')
<div class="space-y-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Balance Card -->
        <div class="lg:col-span-1 bg-slate-900 rounded-[2.5rem] p-10 premium-shadow text-white relative overflow-hidden flex flex-col justify-between">
            <div class="relative z-10">
                <div class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-2">Total Earnings</div>
                <div class="text-5xl font-extrabold mb-8">$142,500.00</div>
                
                <div class="space-y-6">
                    <div>
                        <div class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-1">Available for Withdrawal</div>
                        <div class="text-2xl font-bold text-emerald-400">$12,850.00</div>
                    </div>
                </div>
            </div>
            
            <button class="relative z-10 mt-10 w-full py-5 bg-blue-600 text-white rounded-[2rem] font-bold hover:bg-blue-700 transition-all premium-shadow">
                Withdraw Funds
            </button>

            <!-- Decorative blur -->
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-500/20 rounded-full blur-3xl"></div>
        </div>

        <!-- Charts / Stats -->
        <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-[2.5rem] premium-shadow border border-slate-50">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                        <i data-lucide="trending-up" class="w-5 h-5"></i>
                    </div>
                    <h4 class="font-bold text-slate-900">Revenue Growth</h4>
                </div>
                <div class="h-32 flex items-end gap-2 px-2">
                    @foreach([40, 70, 45, 90, 65, 80, 100] as $h)
                        <div class="flex-1 bg-blue-100 rounded-t-lg group relative cursor-pointer hover:bg-blue-600 transition-all" style="height: {{ $h }}%">
                            <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                ${{ $h * 100 }}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-between mt-4 text-[10px] font-bold text-slate-400 uppercase tracking-tighter">
                    <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
                </div>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] premium-shadow border border-slate-50">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                        <i data-lucide="pie-chart" class="w-5 h-5"></i>
                    </div>
                    <h4 class="font-bold text-slate-900">Payout History</h4>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-2xl">
                        <div class="text-xs font-bold text-slate-700">Apr 15, 2026</div>
                        <div class="text-sm font-extrabold text-slate-900">$5,000.00</div>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-2xl">
                        <div class="text-xs font-bold text-slate-700">Mar 01, 2026</div>
                        <div class="text-sm font-extrabold text-slate-900">$8,200.00</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction History -->
    <div>
        <h3 class="text-2xl font-bold text-slate-900 mb-6">Transaction History</h3>
        <div class="bg-white rounded-[2.5rem] overflow-hidden premium-shadow border border-slate-50">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Transaction ID</th>
                        <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Date</th>
                        <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Description</th>
                        <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <tr class="hover:bg-slate-50 transition-all">
                        <td class="px-8 py-6 font-bold text-slate-900">#TR-88291</td>
                        <td class="px-8 py-6 text-sm text-slate-500">May 12, 2026</td>
                        <td class="px-8 py-6 text-sm font-medium text-slate-700">Booking Payment - #BK-9921</td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-bold uppercase rounded-full tracking-wider">Completed</span>
                        </td>
                        <td class="px-8 py-6 font-extrabold text-emerald-600">+$1,450.00</td>
                    </tr>
                    <tr class="hover:bg-slate-50 transition-all">
                        <td class="px-8 py-6 font-bold text-slate-900">#TR-88290</td>
                        <td class="px-8 py-6 text-sm text-slate-500">May 10, 2026</td>
                        <td class="px-8 py-6 text-sm font-medium text-slate-700">Withdrawal to Bank (**** 4291)</td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-bold uppercase rounded-full tracking-wider">Processing</span>
                        </td>
                        <td class="px-8 py-6 font-extrabold text-rose-500">-$2,000.00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
