@extends('layouts.dashboard')

@section('title', 'Transactions')
@section('header_title', 'Payment History')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Payments & Billing</h1>
            <p class="text-slate-500 font-medium">View all your transactions and download invoices for your trips.</p>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] premium-shadow border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-50 bg-slate-50/50">
            <h3 class="font-bold text-slate-900 text-lg">Transaction History</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                        <th class="px-8 py-5">Transaction ID</th>
                        <th class="px-8 py-5">Date</th>
                        <th class="px-8 py-5">Trip</th>
                        <th class="px-8 py-5">Amount</th>
                        <th class="px-8 py-5">Status</th>
                        <th class="px-8 py-5 text-right">Invoice</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($bookings as $booking)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-8 py-6">
                            <span class="font-bold text-slate-700">#TXN-{{ strtoupper(substr($booking->booking_number, 3)) }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-sm font-bold text-slate-600">{{ $booking->created_at->format('M d, Y') }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-sm font-bold text-slate-900">{{ $booking->departure->tour->title ?? 'Tour Package' }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="font-black text-slate-900">Rs. {{ number_format($booking->total_price) }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-emerald-100">
                                Successful
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <button class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all" title="Download Invoice">
                                <i data-lucide="download" class="w-5 h-5"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-20 text-center">
                            <p class="text-slate-400 font-bold">No transactions found.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
