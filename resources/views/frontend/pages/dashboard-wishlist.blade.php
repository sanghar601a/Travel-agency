@extends('layouts.dashboard')

@section('title', 'My Wishlist')
@section('header_title', 'Saved Adventures')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Your Wishlist</h1>
            <p class="text-slate-500 font-medium">Keep track of the tours you're planning to book in the future.</p>
        </div>
    </div>

    @if(isset($wishlistedTours) && $wishlistedTours->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($wishlistedTours as $tour)
            <div class="group bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-100 flex flex-col h-full">
                <!-- Image -->
                <div class="relative h-56 overflow-hidden">
                    <img src="{{ $tour->featuredImage() }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $tour->title }}" onerror="this.src='https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=800'">
                    <div class="absolute top-4 right-4">
                        <button onclick="toggleWishlistInDashboard(this, {{ $tour->id }})" class="w-10 h-10 bg-rose-500 text-white rounded-xl flex items-center justify-center shadow-lg transition-transform hover:scale-110">
                            <i data-lucide="heart" class="w-5 h-5 fill-current"></i>
                        </button>
                    </div>
                </div>

                <!-- Info -->
                <div class="p-8 flex flex-col flex-1">
                    <div class="flex items-center gap-2 text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] mb-3">
                        <i data-lucide="map-pin" class="w-3 h-3 text-blue-600"></i>
                        {{ $tour->location }}
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 leading-tight mb-6 line-clamp-2">{{ $tour->title }}</h3>
                    
                    <div class="pt-6 border-t border-slate-50 flex items-center justify-between mt-auto">
                        <div>
                            <span class="text-slate-400 text-[8px] font-black uppercase tracking-widest block mb-0.5">Price</span>
                            <span class="text-lg font-black text-slate-900">Rs. {{ number_format($tour->base_price) }}</span>
                        </div>
                        <a href="{{ route('tour.show', $tour->slug) }}" class="px-6 py-3 bg-slate-900 text-white rounded-xl font-black text-[9px] uppercase tracking-widest hover:bg-blue-600 transition-all">
                            Details
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-[3rem] p-20 text-center border-2 border-dashed border-slate-200">
            <div class="w-24 h-24 bg-rose-50 text-rose-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <i data-lucide="heart" class="w-12 h-12 fill-current"></i>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 mb-4">Your wishlist is empty</h3>
            <p class="text-slate-500 max-w-sm mx-auto mb-8">Found a tour you like? Click the heart icon to save it here for later.</p>
            <a href="/tours" class="inline-flex items-center gap-3 px-10 py-4 bg-slate-900 text-white rounded-2xl font-bold shadow-xl hover:bg-blue-600 transition-all">
                Explore Tours
                <i data-lucide="search" class="w-5 h-5"></i>
            </a>
        </div>
    @endif
</div>

@push('scripts')
<script>
function toggleWishlistInDashboard(btn, tourId) {
    fetch(`/wishlist/toggle/${tourId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success' && data.action === 'removed') {
            const card = btn.closest('.group');
            card.classList.add('animate__animated', 'animate__fadeOut', 'animate__faster');
            setTimeout(() => {
                card.remove();
                if (document.querySelectorAll('.grid > .group').length === 0) {
                    location.reload(); // Reload to show empty state
                }
            }, 500);
            
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'info',
                title: 'Removed from Wishlist',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });
        }
    });
}
</script>
@endpush
@endsection
