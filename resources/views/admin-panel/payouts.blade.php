@extends('layouts.admin')

@section('title', 'Vendor Payouts - Admin Panel')
@section('header_title', 'Finance & Payouts')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Vendor Payouts</h1>
            <p class="text-slate-500 font-medium">Manage and approve withdrawal requests from your travel partners.</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="p-4 bg-white rounded-3xl premium-shadow border border-slate-100 flex items-center gap-4">
                <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 font-bold">
                    <i data-lucide="wallet" class="w-6 h-6"></i>
                </div>
                <div>
                    <div class="text-xl font-black text-slate-900">Rs. 125,000</div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pending Payouts</div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] premium-shadow border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
            <h3 class="font-bold text-slate-900 text-lg">Pending Requests</h3>
            <span class="px-4 py-1 bg-indigo-600 text-white text-[10px] font-black uppercase tracking-widest rounded-full">3 New Requests</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                        <th class="px-8 py-5">Agency</th>
                        <th class="px-8 py-5">Request Date</th>
                        <th class="px-8 py-5">Amount</th>
                        <th class="px-8 py-5">Method</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <!-- Mock Payout Request -->
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center font-bold text-slate-400">NT</div>
                                <div>
                                    <div class="font-bold text-slate-900">Northern Travels</div>
                                    <div class="text-[10px] text-slate-400 font-bold uppercase">Vendor ID: #VEN-001</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-sm font-bold text-slate-600">April 28, 2026</div>
                            <div class="text-[10px] text-slate-400 font-medium">10:30 AM</div>
                        </td>
                        <td class="px-8 py-6 text-indigo-600 font-black">Rs. 45,000</td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-2">
                                <div class="p-1.5 bg-blue-50 text-blue-600 rounded-lg">
                                    <i data-lucide="landmark" class="w-4 h-4"></i>
                                </div>
                                <span class="text-sm font-bold text-slate-600">Bank Transfer</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-xs font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/20">Approve</button>
                                <button class="px-4 py-2 bg-slate-100 text-slate-600 rounded-xl text-xs font-bold hover:bg-rose-500 hover:text-white transition-all">Reject</button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center font-bold text-slate-400">SA</div>
                                <div>
                                    <div class="font-bold text-slate-900">Sarah Adventures</div>
                                    <div class="text-[10px] text-slate-400 font-bold uppercase">Vendor ID: #VEN-002</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-sm font-bold text-slate-600">April 27, 2026</div>
                            <div class="text-[10px] text-slate-400 font-medium">04:15 PM</div>
                        </td>
                        <td class="px-8 py-6 text-indigo-600 font-black">Rs. 60,000</td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-2">
                                <div class="p-1.5 bg-blue-50 text-blue-600 rounded-lg">
                                    <i data-lucide="landmark" class="w-4 h-4"></i>
                                </div>
                                <span class="text-sm font-bold text-slate-600">Easypaisa</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-xs font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/20">Approve</button>
                                <button class="px-4 py-2 bg-slate-100 text-slate-600 rounded-xl text-xs font-bold hover:bg-rose-500 hover:text-white transition-all">Reject</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
