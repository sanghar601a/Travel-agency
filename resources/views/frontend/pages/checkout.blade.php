@extends('layouts.app')

@section('title', 'Checkout - PAK TRAVEL')

@section('content')
<div class="pt-32 pb-24 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Checkout Form -->
            <div class="flex-1">
                <div class="mb-8">
                    <a href="{{ route('tour.show', $tour->slug) }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-blue-600 font-bold transition-colors">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        Modify Selection
                    </a>
                </div>
                <!-- Progress Bar -->
                <div class="flex items-center gap-4 mb-12">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">1</div>
                        <span class="font-bold text-slate-900">Traveler Details</span>
                    </div>
                    <div class="flex-1 h-px bg-slate-200"></div>
                    <div class="flex items-center gap-3 opacity-40">
                        <div class="w-10 h-10 bg-white border border-slate-200 text-slate-900 rounded-full flex items-center justify-center font-bold">2</div>
                        <span class="font-bold text-slate-900">Payment</span>
                    </div>
                    <div class="flex-1 h-px bg-slate-200"></div>
                    <div class="flex items-center gap-3 opacity-40">
                        <div class="w-10 h-10 bg-white border border-slate-200 text-slate-900 rounded-full flex items-center justify-center font-bold">3</div>
                        <span class="font-bold text-slate-900">Confirmation</span>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] p-10 premium-shadow border border-slate-50">
                    <h2 class="text-2xl font-bold text-slate-900 mb-8">Traveler Information</h2>
                    <form action="{{ route('booking.store') }}" method="POST" class="space-y-12">
                        @csrf
                        <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                        <input type="hidden" name="departure_id" value="{{ $departure->id }}">
                        <input type="hidden" name="guests" value="{{ $guests }}">

                        @for($i = 0; $i < $guests; $i++)
                        <div class="space-y-6 {{ $i > 0 ? 'pt-10 border-t border-slate-100' : '' }}">
                            <h3 class="text-lg font-bold text-slate-700">Traveler #{{ $i + 1 }} Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Full Name</label>
                                    <input type="text" name="travelers[{{ $i }}][name]" placeholder="Enter full name" class="w-full px-6 py-4 bg-slate-50 border-transparent rounded-2xl focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition-all outline-none" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Age</label>
                                    <input type="number" name="travelers[{{ $i }}][age]" placeholder="Age" class="w-full px-6 py-4 bg-slate-50 border-transparent rounded-2xl focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition-all outline-none" required>
                                </div>
                            </div>
                        </div>
                        @endfor

                        <div class="pt-8 border-t border-slate-100">
                            <h2 class="text-2xl font-bold text-slate-900 mb-8">Payment Method</h2>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <label class="relative flex flex-col items-center gap-4 p-6 border-2 border-slate-100 rounded-2xl cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50/50">
                                    <input type="radio" name="payment" value="stripe" class="absolute top-4 right-4 w-5 h-5 accent-blue-600" checked>
                                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center premium-shadow">
                                        <i data-lucide="credit-card" class="w-6 h-6 text-blue-600"></i>
                                    </div>
                                    <span class="font-bold text-slate-900">Stripe / Card</span>
                                </label>
                                
                                <label class="relative flex flex-col items-center gap-4 p-6 border-2 border-slate-100 rounded-2xl cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50/50">
                                    <input type="radio" name="payment" value="bank" class="absolute top-4 right-4 w-5 h-5 accent-blue-600">
                                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center premium-shadow">
                                        <i data-lucide="landmark" class="w-6 h-6 text-emerald-600"></i>
                                    </div>
                                    <span class="font-bold text-slate-900 text-center leading-tight">Bank Transfer</span>
                                </label>

                                <label class="relative flex flex-col items-center gap-4 p-6 border-2 border-slate-100 rounded-2xl cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50/50">
                                    <input type="radio" name="payment" value="easypaisa" class="absolute top-4 right-4 w-5 h-5 accent-blue-600">
                                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center premium-shadow">
                                        <i data-lucide="wallet" class="w-6 h-6 text-purple-600"></i>
                                    </div>
                                    <span class="font-bold text-slate-900">EasyPaisa</span>
                                </label>
                            </div>
                        </div>

                        <div class="pt-8">
                            <button type="submit" class="w-full py-5 accent-gradient text-white text-center rounded-[2rem] font-extrabold text-lg premium-shadow hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                                Confirm & Pay ${{ number_format($total_price) }}
                            </button>
                            <p class="text-center text-slate-400 text-sm mt-6">
                                By clicking the button, you agree to our <a href="#" class="text-blue-600 underline">Terms and Conditions</a>.
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Order Summary -->
            <aside class="w-full lg:w-[400px] shrink-0">
                <div class="bg-white rounded-[2.5rem] p-8 premium-shadow border border-slate-50 sticky top-32">
                    <h3 class="text-xl font-bold text-slate-900 mb-8">Booking Summary</h3>
                    
                    <div class="flex gap-4 mb-8">
                        <img src="{{ $tour->featuredImage() }}" class="w-24 h-24 rounded-2xl object-cover" alt="Small">
                        <div>
                            <h4 class="font-bold text-slate-900 leading-tight">{{ $tour->title }}</h4>
                            <p class="text-sm text-slate-500 mt-2">{{ $tour->duration_days }} Days</p>
                        </div>
                    </div>

                    <div class="space-y-4 border-t border-slate-100 pt-6 mb-8">
                        <div class="flex justify-between text-slate-500 text-sm font-medium">
                            <span>Travel Date</span>
                            <span class="text-slate-900">{{ \Carbon\Carbon::parse($departure->start_date)->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between text-slate-500 text-sm font-medium">
                            <span>Travelers</span>
                            <span class="text-slate-900">{{ $guests }} Person(s)</span>
                        </div>
                        <div class="flex justify-between text-slate-500 text-sm font-medium">
                            <span>Location</span>
                            <span class="text-slate-900">{{ $tour->location }}</span>
                        </div>
                    </div>

                    <div class="space-y-4 border-t border-slate-100 pt-6">
                        <div class="flex justify-between text-slate-500">
                            <span>Tour Price</span>
                            <span>${{ number_format($tour->base_price) }} x {{ $guests }}</span>
                        </div>
                        <div class="flex justify-between text-slate-900 font-extrabold text-2xl pt-6">
                            <span>Total</span>
                            <span>${{ number_format($total_price) }}</span>
                        </div>
                    </div>

                    <div class="mt-10 p-4 bg-blue-50 rounded-2xl border border-blue-100 flex gap-4">
                        <i data-lucide="shield-check" class="w-6 h-6 text-blue-600 shrink-0"></i>
                        <p class="text-xs text-blue-800 leading-relaxed font-medium">
                            Your payment is secured by industry-standard encryption.
                        </p>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection
