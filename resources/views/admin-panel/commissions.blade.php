@extends('layouts.admin', ['active' => 'commissions'])

@section('header_title', 'Commission Configuration')

@section('content')
<div class="max-w-4xl mx-auto space-y-10">
    <div class="bg-indigo-900 rounded-[3rem] p-12 text-white premium-shadow relative overflow-hidden">
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-10">
            <div>
                <h2 class="text-4xl font-extrabold mb-4">Global Commission Rate</h2>
                <p class="text-indigo-200 text-lg leading-relaxed max-w-md">This rate applies to all new vendor bookings globally unless overridden by specific partner agreements.</p>
            </div>
            <div class="bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-[2.5rem] text-center w-full md:w-64">
                <div class="text-6xl font-black mb-2">15%</div>
                <div class="text-indigo-200 font-bold uppercase tracking-widest text-[10px]">Current Platform Fee</div>
            </div>
        </div>
        <!-- Decorative blur -->
        <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Update Rate Form -->
        <div class="bg-white rounded-[2.5rem] p-10 enterprise-shadow border border-slate-50">
            <h3 class="text-xl font-bold text-slate-900 mb-8">Update Global Rate</h3>
            <form class="space-y-6">
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">New Commission (%)</label>
                    <input type="number" value="15" class="w-full px-6 py-4 bg-slate-50 border-transparent rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 transition-all outline-none text-2xl font-black text-indigo-600">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Effective From</label>
                    <input type="date" class="w-full px-6 py-4 bg-slate-50 border-transparent rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 transition-all outline-none font-bold">
                </div>
                <button class="w-full py-5 bg-indigo-600 text-white rounded-[2rem] font-bold hover:bg-indigo-700 transition-all premium-shadow">Apply Global Change</button>
            </form>
        </div>

        <!-- Custom Partner Rates -->
        <div class="bg-white rounded-[2.5rem] p-10 enterprise-shadow border border-slate-50">
            <h3 class="text-xl font-bold text-slate-900 mb-8">Special Partner Overrides</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-indigo-600 text-white rounded-lg flex items-center justify-center font-bold text-xs">RT</div>
                        <span class="font-bold text-slate-900 text-sm">Royal Travels</span>
                    </div>
                    <span class="text-lg font-black text-indigo-600">12%</span>
                </div>
                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl text-slate-400 italic">
                    <span class="text-xs">No other overrides active</span>
                </div>
                <button class="w-full py-4 border-2 border-dashed border-slate-200 rounded-2xl text-slate-400 font-bold text-sm hover:border-indigo-300 hover:text-indigo-600 transition-all">Add Special Rate</button>
            </div>
        </div>
    </div>
</div>
@endsection
