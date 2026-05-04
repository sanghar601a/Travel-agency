@extends('layouts.dashboard')

@section('title', 'Booking Details')
@section('header_title', 'Reservation Details #' . $booking->booking_number)

@section('content')
<div class="max-w-4xl mx-auto pb-20">
    <div class="mb-6 no-print">
        <a href="{{ route('traveler.bookings') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-blue-600 font-bold transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Back to All Bookings
        </a>
    </div>

    <!-- The Ticket/Invoice Card -->
    <div class="bg-white rounded-[2.5rem] premium-shadow border border-slate-100 overflow-hidden" id="printableInvoice">
        <!-- Header Section -->
        <div class="bg-slate-900 p-10 text-white relative overflow-hidden print:bg-white print:text-slate-900 print:p-0 print:border-b-2 print:border-slate-100">
            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-600/20 blur-[100px] rounded-full -mr-32 -mt-32 print:hidden"></div>
            <div class="relative z-10 flex justify-between items-center">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center print:hidden">
                            <i data-lucide="plane-takeoff" class="w-5 h-5 text-white"></i>
                        </div>
                        <span class="text-xl font-black tracking-tighter">PAK<span class="text-blue-400 print:text-blue-600">TRAVEL</span></span>
                    </div>
                    <h1 class="text-2xl font-black uppercase tracking-tight">Booking Receipt</h1>
                </div>
                <div class="text-right">
                    <div class="text-[10px] font-black text-blue-400 print:text-blue-600 uppercase tracking-[0.2em] mb-1">Invoice Number</div>
                    <div class="text-lg font-black tracking-tight">#{{ $booking->booking_number }}</div>
                </div>
            </div>
        </div>

        <div class="p-10 print:p-8">
            <!-- Grid for Meta Info -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 pb-8 border-b border-slate-100">
                <div>
                    <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Issue Date</div>
                    <div class="text-sm font-bold text-slate-900">{{ $booking->created_at->format('M d, Y') }}</div>
                </div>
                <div>
                    <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Traveler</div>
                    <div class="text-sm font-bold text-slate-900">{{ $booking->user->name }}</div>
                </div>
                <div>
                    <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Method</div>
                    <div class="text-sm font-bold text-slate-900">{{ ucfirst($booking->payment_method) }}</div>
                </div>
                <div>
                    <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Status</div>
                    <div class="text-sm font-black text-emerald-600 uppercase">{{ $booking->status }}</div>
                </div>
            </div>

            <!-- Tour Details -->
            <div class="py-8 border-b border-slate-100 flex gap-8 items-start">
                <div class="hidden md:block w-32 h-24 rounded-2xl overflow-hidden shadow-md print:hidden">
                    <img src="{{ $booking->departure->tour->featuredImage() }}" class="w-full h-full object-cover" alt="Tour">
                </div>
                <div class="flex-1">
                    <div class="text-[9px] font-black text-blue-600 uppercase tracking-[0.2em] mb-1">Adventure Package</div>
                    <h2 class="text-xl font-black text-slate-900 leading-tight mb-4">{{ $booking->departure->tour->title }}</h2>
                    <div class="flex gap-10">
                        <div>
                            <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Location</div>
                            <div class="text-sm font-bold text-slate-700">{{ $booking->departure->tour->location }}</div>
                        </div>
                        <div>
                            <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Travel Date</div>
                            <div class="text-sm font-bold text-slate-700">{{ \Carbon\Carbon::parse($booking->departure->start_date)->format('D, M d, Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Two Column Layout for Travelers and Summary -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 py-8">
                <!-- Traveler List -->
                <div class="space-y-4">
                    <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest flex items-center gap-2 mb-4">
                        <i data-lucide="users" class="w-4 h-4 text-blue-600"></i>
                        Traveler Roster
                    </h3>
                    <div class="space-y-3">
                        @foreach($booking->travelers as $index => $traveler)
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="flex items-center gap-3">
                                <span class="text-[10px] font-black text-slate-300">{{ $index + 1 }}</span>
                                <span class="text-sm font-bold text-slate-700">{{ $traveler->full_name }}</span>
                            </div>
                            <span class="text-[10px] font-black text-slate-400 uppercase">Age: {{ $traveler->age }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Payment Summary -->
                <div class="space-y-4">
                    <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest flex items-center gap-2 mb-4">
                        <i data-lucide="credit-card" class="w-4 h-4 text-blue-600"></i>
                        Financials
                    </h3>
                    <div class="space-y-4 bg-slate-50 rounded-2xl p-6 border border-slate-100">
                        <div class="flex justify-between text-xs font-bold text-slate-500">
                            <span>Base Rate ({{ $booking->guest_count }} Guests)</span>
                            <span>Rs. {{ number_format($booking->total_price) }}</span>
                        </div>
                        <div class="flex justify-between text-xs font-bold text-slate-500">
                            <span>Platform Fees</span>
                            <span class="text-emerald-600">Included</span>
                        </div>
                        <div class="pt-4 border-t border-slate-200 flex justify-between items-end">
                            <div>
                                <div class="text-[8px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Grand Total</div>
                                <div class="text-sm font-bold text-slate-400">{{ strtoupper($booking->payment_status) }}</div>
                            </div>
                            <div class="text-3xl font-black text-slate-900 tracking-tighter">Rs. {{ number_format($booking->total_price) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Message -->
            <div class="mt-8 pt-8 border-t border-dashed border-slate-200 text-center">
                <p class="text-slate-400 text-[9px] font-bold uppercase tracking-[0.3em]">Thank you for choosing Pak Travels Adventure</p>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="mt-8 flex flex-wrap gap-4 no-print">
        <button onclick="window.print()" class="flex-1 min-w-[200px] py-4 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-600 transition-all shadow-lg flex items-center justify-center gap-3">
            <i data-lucide="printer" class="w-4 h-4"></i>
            Print / Save PDF
        </button>
        
        @php
            $departureDate = \Carbon\Carbon::parse($booking->departure->start_date);
            // Professional Logic: Current time + 24 hours must be less than or equal to departure time
            $isWithinWindow = now()->addHours(24)->lte($departureDate);
            $isCancellable = in_array($booking->status, ['pending', 'confirmed']) && $isWithinWindow;
        @endphp

        @if($isCancellable)
        <form action="{{ route('traveler.booking.cancel', $booking->id) }}" method="POST" id="cancelBookingForm" class="flex-1 min-w-[200px]">
            @csrf
            <button type="button" onclick="confirmCancellation()" class="w-full py-4 bg-rose-50 border border-rose-100 text-rose-600 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-rose-600 hover:text-white transition-all flex items-center justify-center gap-3">
                <i data-lucide="x-circle" class="w-4 h-4"></i>
                Cancel Booking
            </button>
        </form>
        @else
        <div class="flex-1 min-w-[200px] flex items-center justify-center p-4 bg-slate-50 rounded-2xl border border-slate-100 opacity-60">
            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest text-center leading-tight">
                <i data-lucide="info" class="w-3 h-3 inline-block mr-1"></i>
                Cancellation Window Closed<br>(Min. 24h Before Departure)
            </span>
        </div>
        @endif

        <a href="mailto:support@paktravel.com" class="px-8 py-4 bg-white border border-slate-200 text-slate-600 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-50 transition-all flex items-center justify-center gap-3">
            <i data-lucide="help-circle" class="w-4 h-4"></i>
            Help
        </a>
    </div>
</div>

<script>
function confirmCancellation() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You are about to cancel your adventure. This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e11d48',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Yes, Cancel it!',
        cancelButtonText: 'Keep it',
        customClass: {
            popup: 'rounded-[2rem]',
            confirmButton: 'rounded-xl font-bold uppercase tracking-widest text-xs px-6 py-3',
            cancelButton: 'rounded-xl font-bold uppercase tracking-widest text-xs px-6 py-3'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('cancelBookingForm').submit();
        }
    })
}
</script>

<style>
@media print {
    .no-print { display: none !important; }
    body { background: white !important; margin: 0 !important; padding: 0 !important; }
    .premium-shadow { box-shadow: none !important; border: none !important; }
    main { margin: 0 !important; padding: 0 !important; }
    header, aside { display: none !important; }
    .max-w-4xl { max-width: 100% !important; width: 100% !important; margin: 0 !important; }
    .rounded-\[2\.5rem\], .rounded-2xl, .rounded-3xl { border-radius: 0 !important; }
    #printableInvoice { border: none !important; }
    
    /* Force single page */
    html, body { height: 99%; overflow: hidden; }
}

@page {
    size: A4;
    margin: 1cm;
}
</style>
@endsection
