@extends('layouts.admin', ['active' => 'support'])

@section('header_title', 'Support Resolution Center')

@section('content')
<div class="space-y-10">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold text-slate-900">Support Tickets</h2>
            <p class="text-slate-500 mt-2">Manage customer inquiries and vendor disputes.</p>
        </div>
        <div class="flex gap-4">
            <button class="px-6 py-3 bg-rose-500 text-white rounded-2xl font-bold text-sm hover:bg-rose-600 transition-all flex items-center gap-2 premium-shadow">
                <i data-lucide="alert-circle" class="w-4 h-4"></i>
                High Priority (3)
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Ticket Filters -->
        <aside class="lg:col-span-1 space-y-4">
            <div class="bg-white p-6 rounded-[2rem] enterprise-shadow border border-slate-50 space-y-2">
                <button class="w-full text-left px-6 py-3 rounded-xl bg-indigo-600 text-white font-bold text-sm">All Tickets</button>
                <button class="w-full text-left px-6 py-3 rounded-xl hover:bg-slate-50 text-slate-600 font-bold text-sm transition-all">New (12)</button>
                <button class="w-full text-left px-6 py-3 rounded-xl hover:bg-slate-50 text-slate-600 font-bold text-sm transition-all">In Progress (8)</button>
                <button class="w-full text-left px-6 py-3 rounded-xl hover:bg-slate-50 text-slate-600 font-bold text-sm transition-all">Resolved</button>
            </div>
            
            <div class="bg-indigo-50 p-6 rounded-[2rem] border border-indigo-100">
                <h4 class="font-bold text-indigo-900 text-sm mb-2">Resolution Rate</h4>
                <div class="text-3xl font-black text-indigo-600 mb-4">98.2%</div>
                <div class="w-full bg-white h-2 rounded-full overflow-hidden">
                    <div class="bg-indigo-600 h-full" style="width: 98%"></div>
                </div>
                <p class="text-[10px] text-indigo-400 font-bold uppercase mt-4 tracking-widest">Average Response: 12m</p>
            </div>
        </aside>

        <!-- Ticket List -->
        <div class="lg:col-span-3 space-y-6">
            <!-- Ticket 1 -->
            <div class="bg-white p-8 rounded-[2.5rem] enterprise-shadow border border-slate-50 group hover:border-indigo-100 transition-all cursor-pointer">
                <div class="flex flex-col md:flex-row justify-between gap-6">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-3 py-1 bg-rose-50 text-rose-600 text-[10px] font-bold uppercase rounded-full tracking-wider">Critical Dispute</span>
                            <span class="text-xs text-slate-400 font-bold">#TK-9021 • 15m ago</span>
                        </div>
                        <h4 class="text-xl font-extrabold text-slate-900 mb-3 group-hover:text-indigo-600 transition-colors">Booking Cancellation Refund Dispute</h4>
                        <p class="text-slate-500 text-sm line-clamp-2">Traveler Ahmed Khan is requesting a full refund for Skardu Tour #BK-9921 due to sudden health issues, but vendor Royal Travels has a strict no-refund policy...</p>
                    </div>
                    <div class="flex flex-col items-end justify-between">
                        <div class="flex -space-x-3">
                            <img src="https://i.pravatar.cc/150?u=Ahmed" class="w-10 h-10 rounded-full border-2 border-white" title="Traveler">
                            <img src="https://ui-avatars.com/api/?name=Royal+Travels&background=0D8ABC&color=fff" class="w-10 h-10 rounded-full border-2 border-white" title="Vendor">
                        </div>
                        <button class="px-6 py-2 border border-slate-200 rounded-xl font-bold text-xs hover:bg-slate-900 hover:text-white transition-all">Assign To Me</button>
                    </div>
                </div>
            </div>

            <!-- Ticket 2 -->
            <div class="bg-white p-8 rounded-[2.5rem] enterprise-shadow border border-slate-50 group hover:border-indigo-100 transition-all cursor-pointer">
                <div class="flex flex-col md:flex-row justify-between gap-6">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-bold uppercase rounded-full tracking-wider">Inquiry</span>
                            <span class="text-xs text-slate-400 font-bold">#TK-9022 • 2h ago</span>
                        </div>
                        <h4 class="text-xl font-extrabold text-slate-900 mb-3 group-hover:text-indigo-600 transition-colors">Corporate Tour Partnership Inquiry</h4>
                        <p class="text-slate-500 text-sm line-clamp-2">Potential partner looking for API access and corporate rates for a team of 200+ employees traveling to Northern areas...</p>
                    </div>
                    <div class="flex flex-col items-end justify-between">
                        <button class="px-6 py-2 border border-slate-200 rounded-xl font-bold text-xs hover:bg-slate-900 hover:text-white transition-all">Assign To Me</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
