<div class="p-8">
    <div class="flex justify-between items-start mb-8 pb-8 border-b border-slate-100">
        <div>
            <div class="text-[10px] font-black text-blue-600 uppercase tracking-widest mb-2">Booking Reference</div>
            <h3 class="text-3xl font-black text-slate-900 tracking-tight">#{{ $booking->booking_number }}</h3>
        </div>
        <div class="text-right">
            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Travel Date</div>
            <div class="text-lg font-bold text-slate-900">{{ \Carbon\Carbon::parse($booking->departure->start_date)->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-10">
        <!-- Customer Details -->
        <div>
            <h4 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Customer Information</h4>
            <div class="flex items-center gap-4 p-5 bg-slate-50 rounded-3xl border border-slate-100">
                <img src="{{ $booking->user->avatar ? asset('storage/' . $booking->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($booking->user->name) }}" class="w-12 h-12 rounded-2xl border border-white shadow-sm">
                <div>
                    <div class="font-bold text-slate-900">{{ $booking->user->name }}</div>
                    <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">{{ $booking->user->email }}</div>
                </div>
            </div>
        </div>

        <!-- Tour Package -->
        <div>
            <h4 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Package Details</h4>
            <div class="p-5 bg-blue-50 rounded-3xl border border-blue-100">
                <div class="font-bold text-blue-900">{{ $booking->departure->tour->title }}</div>
                <div class="text-[10px] text-blue-400 font-bold uppercase tracking-widest mt-1">{{ $booking->departure->tour->location }}</div>
            </div>
        </div>
    </div>

    <!-- Traveler Roster -->
    <div class="mb-10">
        <h4 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Traveler Roster ({{ $booking->guest_count }})</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($booking->travelers as $traveler)
            <div class="flex items-center justify-between p-4 bg-white border border-slate-100 rounded-2xl">
                <div class="font-bold text-slate-700 text-sm">{{ $traveler->full_name }}</div>
                <div class="text-[10px] font-black text-slate-400 uppercase">Age: {{ $traveler->age }}</div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Payment Summary -->
    <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white">
        <div class="flex justify-between items-center mb-6">
            <span class="text-white/50 text-xs font-bold uppercase tracking-widest">Total Price</span>
            <span class="text-2xl font-black italic">Rs. {{ number_format($booking->total_price) }}</span>
        </div>
        <div class="flex justify-between items-center pt-6 border-t border-white/10">
            <div>
                <div class="text-blue-400 text-[10px] font-black uppercase tracking-widest">Your Earning</div>
                <div class="text-xs text-white/40 mt-1">After 10% Platform Commission</div>
            </div>
            <div class="text-3xl font-black text-emerald-400 tracking-tighter">Rs. {{ number_format($booking->vendor_earning) }}</div>
        </div>
    </div>
</div>
