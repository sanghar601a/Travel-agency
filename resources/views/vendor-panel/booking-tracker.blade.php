@extends('layouts.vendor', ['active' => 'bookings'])

@section('header_title', 'Booking Tracker')

@section('content')
<div class="space-y-10">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold text-slate-900">All Bookings</h2>
            <p class="text-slate-500 mt-2">Manage and track all traveler reservations in real-time.</p>
        </div>
        <div class="flex flex-wrap gap-4 items-center">
            <form action="{{ route('vendor.bookings') }}" method="GET" class="relative">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or ID..." class="pl-11 pr-4 py-3 bg-white border border-slate-100 rounded-2xl text-sm focus:ring-2 focus:ring-blue-600/20 outline-none premium-shadow w-[250px]">
            </form>
            <a href="{{ route('vendor.bookings.export') }}" class="px-6 py-3 bg-slate-900 text-white rounded-2xl font-bold text-sm hover:bg-blue-600 transition-all flex items-center gap-2">
                <i data-lucide="download" class="w-4 h-4"></i>
                Export CSV
            </a>
        </div>
    </div>

    <!-- Booking Table -->
    <div class="bg-white rounded-[2.5rem] overflow-hidden premium-shadow border border-slate-50">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Booking & ID</th>
                    <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Traveler</th>
                    <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Package</th>
                    <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Earnings</th>
                    <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Payment</th>
                    <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Status</th>
                    <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($bookings as $booking)
                <tr class="hover:bg-slate-50 transition-all border-b border-slate-50 last:border-0">
                    <td class="px-8 py-6">
                        <div class="font-black text-slate-900">#{{ $booking->booking_number }}</div>
                        <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">{{ $booking->created_at->format('M d, Y') }}</div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-3">
                            <img src="{{ $booking->user->avatar ? asset('storage/' . $booking->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($booking->user->name) }}" class="w-10 h-10 rounded-xl border border-slate-100" alt="User">
                            <div>
                                <div class="font-bold text-slate-900 leading-none">{{ $booking->user->name }}</div>
                                <div class="text-[10px] text-slate-400 font-bold mt-1 uppercase tracking-tighter">{{ $booking->guest_count }} Person(s)</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-sm font-bold text-slate-700 leading-tight">{{ $booking->departure->tour->title }}</div>
                        <div class="text-[10px] text-blue-600 font-bold mt-1 uppercase tracking-widest">{{ \Carbon\Carbon::parse($booking->departure->start_date)->format('M d, Y') }}</div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex flex-col gap-1">
                            <div class="text-sm font-black text-slate-900">Rs. {{ number_format($booking->vendor_earning) }}</div>
                            <div class="text-[9px] text-slate-400 font-bold uppercase tracking-tighter">After {{ number_format($booking->commission_amount) }} Comm.</div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-2">
                            @php
                                $pmIcons = ['stripe' => 'credit-card', 'bank' => 'landmark', 'easypaisa' => 'wallet'];
                                $pmColors = ['stripe' => 'text-blue-600', 'bank' => 'text-emerald-600', 'easypaisa' => 'text-purple-600'];
                            @endphp
                            <i data-lucide="{{ $pmIcons[$booking->payment_method] ?? 'circle-dollar-sign' }}" class="w-4 h-4 {{ $pmColors[$booking->payment_method] ?? 'text-slate-400' }}"></i>
                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-600">{{ $booking->payment_method ?? 'Unknown' }}</span>
                        </div>
                        <div class="mt-1">
                            <span class="text-[9px] font-bold uppercase px-2 py-0.5 rounded-full {{ $booking->payment_status === 'paid' ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                                {{ $booking->payment_status }}
                            </span>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        @php
                            $statusStyles = [
                                'confirmed' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                'pending' => 'bg-amber-50 text-amber-600 border-amber-100',
                                'cancelled' => 'bg-rose-50 text-rose-600 border-rose-100',
                            ];
                        @endphp
                        <span class="px-4 py-1.5 border {{ $statusStyles[$booking->status] ?? 'bg-slate-50 text-slate-500' }} text-[9px] font-black uppercase rounded-full tracking-wider">
                            {{ $booking->status }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button onclick="openBookingDetails({{ $booking->id }})" class="p-2 bg-slate-100 text-slate-500 rounded-lg hover:bg-blue-600 hover:text-white transition-all shadow-sm" title="View Details">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </button>
                            @if($booking->status === 'pending')
                            <form action="{{ route('vendor.bookings.confirm', $booking->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="p-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-all shadow-lg shadow-emerald-500/20" title="Confirm Booking">
                                    <i data-lucide="check" class="w-4 h-4"></i>
                                </button>
                            </form>
                            <form action="{{ route('vendor.bookings.cancel', $booking->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="p-2 bg-rose-500 text-white rounded-lg hover:bg-rose-600 transition-all shadow-lg shadow-rose-500/20" title="Cancel Booking">
                                    <i data-lucide="x" class="w-4 h-4"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-8 py-10 text-center text-slate-400 font-bold">
                        No bookings found for your tours.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openBookingDetails(bookingId) {
    Swal.fire({
        title: 'Loading Details...',
        html: '<div class="py-10 text-center"><i data-lucide="loader-2" class="w-10 h-10 text-blue-600 animate-spin mx-auto"></i></div>',
        showConfirmButton: false,
        width: '800px',
        customClass: {
            popup: 'rounded-[3rem]',
        },
        didOpen: () => {
            fetch(`/vendor/bookings/${bookingId}`)
                .then(response => response.text())
                .then(html => {
                    Swal.update({
                        html: html,
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        confirmButtonColor: '#0f172a',
                        customClass: {
                            popup: 'rounded-[3rem]',
                            confirmButton: 'rounded-2xl px-10 py-3 font-bold uppercase tracking-widest text-xs'
                        }
                    });
                    // Re-initialize Lucide icons in the modal
                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons();
                    }
                });
        }
    });
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput) {
        let timeout = null;
        
        searchInput.addEventListener('input', function() {
            clearTimeout(timeout);
            
            // If empty, submit immediately
            if (this.value === '') {
                this.form.submit();
                return;
            }
            
            // Otherwise, debounce for 500ms
            timeout = setTimeout(() => {
                this.form.submit();
            }, 500);
        });

        // Handle 'x' clear button
        searchInput.addEventListener('search', function() {
            if (this.value === '') {
                this.form.submit();
            }
        });
    }
}
</script>
@endpush
