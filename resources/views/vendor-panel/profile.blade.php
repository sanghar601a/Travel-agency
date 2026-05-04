@extends('layouts.vendor', ['active' => 'profile'])

@section('content')
<div class="max-w-5xl space-y-12 pb-20">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-2">Agency Profile</h1>
            <p class="text-slate-500 font-medium">Manage your professional identity and account security.</p>
        </div>
        <div class="px-6 py-3 bg-white rounded-2xl border border-slate-100 flex items-center gap-3 enterprise-shadow">
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Account Status:</span>
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 {{ auth()->user()->vendor->status === 'active' ? 'bg-emerald-500' : 'bg-amber-500' }} rounded-full animate-pulse"></div>
                <span class="text-xs font-bold text-slate-700 capitalize">{{ auth()->user()->vendor->status }}</span>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-3 animate__animated animate__fadeIn">
            <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i>
            <span class="text-sm font-bold text-emerald-700">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Main Form -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white p-10 rounded-[3rem] enterprise-shadow border border-slate-50">
                <form action="{{ route('vendor.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    
                    <!-- Agency Brand Section -->
                    <div class="flex items-center gap-8 pb-8 border-b border-slate-50">
                        <div x-data="{ photoPreview: null }" class="relative group">
                            <input type="file" name="avatar" class="hidden" x-ref="photo" 
                                x-on:change="
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                                ">
                            <div class="w-28 h-28 rounded-[2rem] bg-slate-50 border-2 border-dashed border-slate-200 flex items-center justify-center overflow-hidden transition-all duration-500 group-hover:border-indigo-600 cursor-pointer" @click="$refs.photo.click()">
                                <template x-if="!photoPreview">
                                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->vendor->agency_name) . '&background=4f46e5&color=fff' }}" class="w-full h-full object-cover">
                                </template>
                                <template x-if="photoPreview">
                                    <img :src="photoPreview" class="w-full h-full object-cover">
                                </template>
                            </div>
                            <button type="button" class="absolute -bottom-2 -right-2 w-10 h-10 bg-slate-900 text-white rounded-2xl shadow-xl flex items-center justify-center hover:bg-indigo-600 transition-all" @click="$refs.photo.click()">
                                <i data-lucide="camera" class="w-5 h-5"></i>
                            </button>
                        </div>
                        <div>
                            <h4 class="text-xl font-black text-slate-900">Agency Logo</h4>
                            <p class="text-slate-400 text-sm font-medium mt-1">This will be shown on all your tour packages.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Agency Details -->
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-slate-300 uppercase tracking-widest mb-3 ml-1">Agency Public Name</label>
                            <input type="text" name="agency_name" value="{{ $vendor->agency_name }}" required class="w-full px-8 py-4.5 bg-slate-50 border-transparent rounded-3xl outline-none font-bold text-slate-900 focus:bg-white focus:ring-4 focus:ring-indigo-600/10 transition-all">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-slate-300 uppercase tracking-widest mb-3 ml-1">Agency Bio / Description</label>
                            <textarea name="bio" rows="4" class="w-full px-8 py-4.5 bg-slate-50 border-transparent rounded-3xl outline-none font-bold text-slate-900 focus:bg-white focus:ring-4 focus:ring-indigo-600/10 transition-all resize-none" placeholder="Tell travelers about your agency...">{{ $vendor->bio }}</textarea>
                        </div>

                        <!-- Personal Details -->
                        <div>
                            <label class="block text-[10px] font-black text-slate-300 uppercase tracking-widest mb-3 ml-1">Owner Name</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" required class="w-full px-8 py-4.5 bg-slate-50 border-transparent rounded-3xl outline-none font-bold text-slate-900 focus:bg-white focus:ring-4 focus:ring-indigo-600/10 transition-all">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-slate-300 uppercase tracking-widest mb-3 ml-1">Official Email</label>
                            <input type="email" name="email" value="{{ auth()->user()->email }}" required class="w-full px-8 py-4.5 bg-slate-50 border-transparent rounded-3xl outline-none font-bold text-slate-900 focus:bg-white focus:ring-4 focus:ring-indigo-600/10 transition-all">
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full py-5 bg-slate-900 text-white rounded-[2rem] font-black text-sm uppercase tracking-widest hover:bg-indigo-600 transition-all duration-300 shadow-xl shadow-slate-200">
                            Update Agency Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar Section -->
        <div class="space-y-8">
            <!-- Security Card -->
            <div class="bg-white p-10 rounded-[3rem] enterprise-shadow border border-slate-50">
                <div class="mb-8 flex items-center gap-4">
                    <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-indigo-600">
                        <i data-lucide="lock" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-black text-slate-900 leading-none">Security</h4>
                        <p class="text-slate-400 text-[10px] font-bold mt-1">Change Account Password</p>
                    </div>
                </div>

                <form action="{{ route('vendor.profile.password') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black text-slate-300 uppercase tracking-widest mb-2 ml-1">Current</label>
                        <input type="password" name="current_password" required class="w-full px-6 py-4 bg-slate-50 border-transparent rounded-2xl outline-none font-bold text-slate-900 focus:bg-white focus:ring-4 focus:ring-indigo-600/10 transition-all text-xs">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-300 uppercase tracking-widest mb-2 ml-1">New Password</label>
                        <input type="password" name="password" required class="w-full px-6 py-4 bg-slate-50 border-transparent rounded-2xl outline-none font-bold text-slate-900 focus:bg-white focus:ring-4 focus:ring-indigo-600/10 transition-all text-xs">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-300 uppercase tracking-widest mb-2 ml-1">Confirm</label>
                        <input type="password" name="password_confirmation" required class="w-full px-6 py-4 bg-slate-50 border-transparent rounded-2xl outline-none font-bold text-slate-900 focus:bg-white focus:ring-4 focus:ring-indigo-600/10 transition-all text-xs">
                    </div>

                    <button type="submit" class="w-full py-4 bg-indigo-600 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-slate-900 transition-all duration-300 shadow-xl shadow-indigo-100">
                        Change Password
                    </button>
                </form>
            </div>

            <!-- Support Card -->
            <div class="p-8 bg-slate-900 rounded-[2.5rem] text-white">
                <i data-lucide="help-circle" class="w-8 h-8 text-indigo-400 mb-4"></i>
                <h5 class="text-lg font-black mb-2">Need Assistance?</h5>
                <p class="text-slate-400 text-xs font-medium leading-relaxed mb-6">If you need to change your registered mobile number or bank details, please contact our partner support team.</p>
                <a href="#" class="inline-flex items-center gap-2 text-xs font-black text-indigo-400 hover:text-white transition-colors">
                    Contact Support <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
