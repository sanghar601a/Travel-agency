@extends('layouts.admin', ['active' => 'vendors'])

@section('header_title', 'Vendor Management')

@section('content')
<div class="space-y-10" x-data="{ 
    showModal: false, 
    selectedVendor: {
        agency_name: '',
        owner: '',
        email: '',
        phone: '',
        status: '',
        created_at: '',
        tours_count: 0,
        bio: '',
        logo: ''
    } 
}">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold text-slate-900">All Partners</h2>
            <p class="text-slate-500 mt-2">Oversee and verify travel agencies across the platform.</p>
        </div>
        <div class="flex gap-4">
            <div class="bg-white px-6 py-3 rounded-2xl enterprise-shadow border border-slate-50 flex items-center gap-3">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Global Status:</span>
                <span class="text-sm font-bold text-emerald-600">All Systems Online</span>
            </div>
        </div>
    </div>

    <!-- Vendor Filters -->
    <div class="bg-white p-8 rounded-[2.5rem] enterprise-shadow border border-slate-50">
        <form action="{{ route('admin.vendors') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="md:col-span-2 relative">
                <i data-lucide="search" class="absolute left-6 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by agency name, owner, or ID..." class="w-full pl-14 pr-6 py-4 bg-slate-50 border-transparent rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 transition-all outline-none font-medium">
            </div>
            <div class="relative">
                <select name="status" onchange="this.form.submit()" class="w-full px-6 py-4 bg-slate-50 border-transparent rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 transition-all outline-none font-bold text-slate-700 appearance-none">
                    <option value="">All Statuses</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Verified</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                <i data-lucide="chevron-down" class="absolute right-6 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
            </div>
            <div class="relative">
                <select name="category" onchange="this.form.submit()" class="w-full px-6 py-4 bg-slate-50 border-transparent rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-600/20 transition-all outline-none font-bold text-slate-700 appearance-none">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <i data-lucide="chevron-down" class="absolute right-6 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
            </div>
        </form>
    </div>

    <!-- Vendor Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @foreach($vendors as $vendor)
        <div class="bg-white rounded-[2.5rem] p-8 enterprise-shadow border border-slate-50 relative group hover:-translate-y-2 transition-all duration-500">
            <div class="flex items-start justify-between mb-8">
                @php
                    $logoUrl = $vendor->logo ? asset('storage/' . $vendor->logo) : 'https://ui-avatars.com/api/?name=' . urlencode($vendor->agency_name) . '&background=random&color=fff';
                @endphp
                <img src="{{ $logoUrl }}" class="w-16 h-16 rounded-2xl object-cover" alt="{{ $vendor->agency_name }}">
                <span class="px-3 py-1 {{ $vendor->status == 'active' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }} text-[10px] font-bold uppercase rounded-full tracking-wider">
                    {{ $vendor->status == 'active' ? 'Verified' : ucfirst($vendor->status) }}
                </span>
            </div>
            <h4 class="text-xl font-extrabold text-slate-900 mb-2">{{ $vendor->agency_name }}</h4>
            <p class="text-slate-400 text-sm mb-6 line-clamp-2">{{ $vendor->bio ?? 'Verified tourism operator specializing in Pakistan.' }}</p>
            
            <div class="grid grid-cols-2 gap-4 py-6 border-t border-slate-50">
                <div>
                    <div class="text-[10px] uppercase font-bold text-slate-400">Total Tours</div>
                    <div class="text-lg font-bold text-slate-900">{{ $vendor->tours->count() }}</div>
                </div>
                <div>
                    <div class="text-[10px] uppercase font-bold text-slate-400">Owner</div>
                    <div class="text-sm font-bold text-slate-900 truncate">{{ $vendor->user->name }}</div>
                </div>
            </div>

            <div class="flex gap-3">
                <button @click="
                    selectedVendor = {
                        agency_name: '{{ $vendor->agency_name }}',
                        owner: '{{ $vendor->user->name }}',
                        email: '{{ $vendor->user->email }}',
                        phone: '{{ $vendor->user->phone ?? 'Not provided' }}',
                        status: '{{ $vendor->status }}',
                        created_at: '{{ $vendor->created_at->format('M d, Y') }}',
                        tours_count: '{{ $vendor->tours->count() }}',
                        bio: '{{ $vendor->bio ?? 'Verified tourism operator specializing in Pakistan.' }}',
                        logo: '{{ $logoUrl }}'
                    };
                    showModal = true;
                " class="flex-1 py-3 bg-slate-900 text-white rounded-xl font-bold text-xs hover:bg-indigo-600 transition-all">View Details</button>
                
                <div class="flex gap-2">
                    @if($vendor->status == 'pending' || $vendor->status == 'suspended')
                        <form action="{{ route('admin.vendors.status', $vendor->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="active">
                            <button type="submit" class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center hover:bg-emerald-600 hover:text-white transition-all" title="Activate/Approve Vendor">
                                <i data-lucide="check-circle" class="w-5 h-5"></i>
                            </button>
                        </form>
                    @endif

                    @if($vendor->status == 'active')
                        <form action="{{ route('admin.vendors.status', $vendor->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="suspended">
                            <button type="submit" class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center hover:bg-amber-600 hover:text-white transition-all" title="Suspend Vendor">
                                <i data-lucide="pause-circle" class="w-5 h-5"></i>
                            </button>
                        </form>
                    @endif

                    @if($vendor->status != 'rejected')
                        <form action="{{ route('admin.vendors.status', $vendor->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to reject this vendor?')">
                            @csrf
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="w-12 h-12 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center hover:bg-rose-600 hover:text-white transition-all" title="Reject/Ban Vendor">
                                <i data-lucide="slash" class="w-5 h-5"></i>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Details Modal -->
    <div x-show="showModal" 
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 md:p-8"
         x-cloak>
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" 
             @click="showModal = false"
             x-show="showModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"></div>

        <!-- Modal Content -->
        <div class="bg-white w-full max-w-2xl rounded-[2.5rem] shadow-2xl border border-slate-100 relative overflow-hidden z-10 max-h-[90vh] flex flex-col"
             x-show="showModal"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-8 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100">
            
            <!-- Modal Header -->
            <div class="p-8 pb-4 flex justify-between items-center border-b border-slate-50">
                <div class="flex items-center gap-5">
                    <img :src="selectedVendor.logo" class="w-14 h-14 rounded-2xl object-cover shadow-lg shadow-slate-100" alt="Logo">
                    <div>
                        <h2 class="text-2xl font-black text-slate-900 leading-tight" x-text="selectedVendor.agency_name"></h2>
                        <div class="flex items-center gap-3 mt-1">
                            <span class="px-2 py-0.5 bg-indigo-50 text-indigo-600 text-[9px] font-black rounded-md uppercase tracking-wider" x-text="selectedVendor.status"></span>
                            <span class="text-[10px] text-slate-400 font-bold" x-text="'Joined ' + selectedVendor.created_at"></span>
                        </div>
                    </div>
                </div>
                <button @click="showModal = false" class="w-10 h-10 bg-slate-50 text-slate-400 rounded-full flex items-center justify-center hover:bg-rose-50 hover:text-rose-600 transition-all">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Modal Body (Scrollable) -->
            <div class="p-8 overflow-y-auto space-y-8 custom-scrollbar">
                <!-- Bio Section -->
                <div>
                    <label class="block text-[10px] font-black text-slate-300 uppercase tracking-widest mb-2">Agency Overview</label>
                    <p class="text-slate-500 text-sm font-medium leading-relaxed bg-slate-50 p-5 rounded-2xl italic border border-slate-100" x-text="selectedVendor.bio"></p>
                </div>

                <!-- Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-5 bg-white border border-slate-100 rounded-2xl">
                        <label class="block text-[10px] font-black text-slate-300 uppercase tracking-widest mb-3">Ownership</label>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center">
                                <i data-lucide="user" class="w-5 h-5 text-indigo-600"></i>
                            </div>
                            <div>
                                <div class="text-sm font-black text-slate-900" x-text="selectedVendor.owner"></div>
                                <div class="text-[10px] font-bold text-slate-400">Primary Contact</div>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 bg-white border border-slate-100 rounded-2xl">
                        <label class="block text-[10px] font-black text-slate-300 uppercase tracking-widest mb-3">Communication</label>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center">
                                <i data-lucide="phone" class="w-5 h-5 text-indigo-600"></i>
                            </div>
                            <div>
                                <div class="text-sm font-black text-slate-900" x-text="selectedVendor.phone"></div>
                                <div class="text-[10px] font-bold text-slate-400">Mobile Verified</div>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2 p-5 bg-white border border-slate-100 rounded-2xl flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center">
                                <i data-lucide="mail" class="w-5 h-5 text-indigo-600"></i>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-300 uppercase tracking-widest mb-0.5">Email Address</label>
                                <div class="text-sm font-bold text-slate-700" x-text="selectedVendor.email"></div>
                            </div>
                        </div>
                        <a :href="'mailto:' + selectedVendor.email" class="px-4 py-2 bg-slate-900 text-white text-[10px] font-black rounded-lg hover:bg-indigo-600 transition-all uppercase tracking-widest">Send Mail</a>
                    </div>
                </div>

                <!-- Stats Footer Card -->
                <div class="bg-indigo-600 p-6 rounded-3xl text-white flex justify-between items-center shadow-xl shadow-indigo-100/50">
                    <div>
                        <div class="text-[10px] font-bold text-indigo-200 uppercase tracking-widest mb-1">Total Active Tours</div>
                        <div class="text-3xl font-black" x-text="selectedVendor.tours_count"></div>
                    </div>
                    <div class="w-14 h-14 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center">
                        <i data-lucide="palmtree" class="w-7 h-7 text-white"></i>
                    </div>
                </div>
            </div>

            <!-- Modal Action Footer -->
            <div class="p-8 pt-4 border-t border-slate-50 bg-slate-50/50 flex gap-4">
                <button @click="showModal = false" class="flex-1 py-4 bg-white border border-slate-200 text-slate-700 rounded-2xl font-bold hover:bg-slate-100 transition-all shadow-sm">Dismiss</button>
                <button class="flex-1 py-4 bg-slate-900 text-white rounded-2xl font-bold hover:bg-indigo-600 transition-all shadow-lg shadow-slate-200">Manage Assets</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[name="search"]');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    if (this.value === '') {
                        this.form.submit();
                    }
                });
                
                // Handle the 'x' button in search inputs
                searchInput.addEventListener('search', function() {
                    if (this.value === '') {
                        this.form.submit();
                    }
                });
            }
        });
    </script>
@endpush
@endsection
