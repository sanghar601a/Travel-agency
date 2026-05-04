@extends('layouts.vendor')

@section('title', 'Tour Reviews - Vendor Panel')
@section('header_title', 'Traveler Reviews')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Recent Feedback</h1>
            <p class="text-slate-500 font-medium">Hear what travelers are saying about your tour experiences.</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="p-4 bg-white rounded-3xl premium-shadow border border-slate-100 flex items-center gap-4">
                <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-500">
                    <i data-lucide="star" class="w-6 h-6 fill-current"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-slate-900">4.8</div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Average Rating</div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6">
        <!-- Mock Review Item -->
        <div class="bg-white rounded-[2.5rem] p-8 premium-shadow border border-slate-100 hover:border-blue-200 transition-all group">
            <div class="flex flex-col md:flex-row gap-8">
                <div class="flex-shrink-0">
                    <img src="https://ui-avatars.com/api/?name=Sarah+Johnson&background=random" class="w-20 h-20 rounded-3xl border-4 border-slate-50" alt="Sarah">
                </div>
                <div class="flex-1 space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">Sarah Johnson</h3>
                            <p class="text-slate-400 text-sm font-medium">Reviewed: <span class="text-blue-600">Northern Peaks Discovery</span></p>
                        </div>
                        <div class="text-right">
                            <div class="flex items-center gap-1 text-amber-400 mb-1">
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            </div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">2 Days Ago</span>
                        </div>
                    </div>
                    <p class="text-slate-600 leading-relaxed font-medium">
                        "The tour was absolutely breathtaking! The guide was very knowledgeable and the accommodations were top-notch. I highly recommend this agency for anyone looking for an authentic adventure in Pakistan."
                    </p>
                    <div class="pt-4 flex items-center gap-4">
                        <button class="px-6 py-2 bg-slate-50 text-slate-600 rounded-xl font-bold text-sm hover:bg-blue-600 hover:text-white transition-all">Reply to Review</button>
                        <button class="text-slate-400 hover:text-rose-500 font-bold text-sm transition-all">Report</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- No Reviews State (Hidden for demo) -->
        <div class="hidden bg-white rounded-[3rem] p-20 text-center border-2 border-dashed border-slate-200">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                <i data-lucide="message-square" class="w-10 h-10"></i>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 mb-2">No reviews yet</h3>
            <p class="text-slate-500 max-w-xs mx-auto">Once travelers complete your tours, their feedback will appear here.</p>
        </div>
    </div>
</div>
@endsection
