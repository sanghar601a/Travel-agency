@extends('layouts.admin', ['active' => 'profile'])

@section('header_title', 'Account Settings')

@section('content')
<div class="max-w-4xl space-y-12 pb-20">
    <!-- Header -->
    <div>
        <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-2">My Profile</h1>
        <p class="text-slate-500 font-medium">Manage your administrator account details and security settings.</p>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-3 animate__animated animate__fadeIn">
            <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i>
            <span class="text-sm font-bold text-emerald-700">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Profile Details Card -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white p-10 rounded-[3rem] enterprise-shadow border border-slate-50">
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    
                    <!-- Avatar Upload -->
                    <div class="flex items-center gap-8">
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
                                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=4f46e5&color=fff' }}" class="w-full h-full object-cover">
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
                            <h4 class="text-xl font-black text-slate-900">Profile Picture</h4>
                            <p class="text-slate-400 text-sm font-medium mt-1">Update your professional avatar.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-slate-300 uppercase tracking-widest mb-3 ml-1">Full Display Name</label>
                            <div class="relative group">
                                <i data-lucide="user" class="absolute left-6 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-300 group-focus-within:text-indigo-600 transition-colors"></i>
                                <input type="text" name="name" value="{{ auth()->user()->name }}" required class="w-full pl-16 pr-8 py-4.5 bg-slate-50 border-transparent rounded-3xl outline-none font-bold text-slate-900 focus:bg-white focus:ring-4 focus:ring-indigo-600/10 transition-all">
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-slate-300 uppercase tracking-widest mb-3 ml-1">Official Email Address</label>
                            <div class="relative group">
                                <i data-lucide="mail" class="absolute left-6 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-300 group-focus-within:text-indigo-600 transition-colors"></i>
                                <input type="email" name="email" value="{{ auth()->user()->email }}" required class="w-full pl-16 pr-8 py-4.5 bg-slate-50 border-transparent rounded-3xl outline-none font-bold text-slate-900 focus:bg-white focus:ring-4 focus:ring-indigo-600/10 transition-all">
                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full py-5 bg-slate-900 text-white rounded-[2rem] font-black text-sm uppercase tracking-widest hover:bg-indigo-600 transition-all duration-300 shadow-xl shadow-slate-200">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Security Card -->
        <div class="space-y-8">
            <div class="bg-white p-10 rounded-[3rem] enterprise-shadow border border-slate-50">
                <div class="mb-8">
                    <h4 class="text-xl font-black text-slate-900">Security</h4>
                    <p class="text-slate-400 text-sm font-medium mt-1">Change your account password.</p>
                </div>

                <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black text-slate-300 uppercase tracking-widest mb-3 ml-1">Current Password</label>
                        <input type="password" name="current_password" required class="w-full px-8 py-4 bg-slate-50 border-transparent rounded-2xl outline-none font-bold text-slate-900 focus:bg-white focus:ring-4 focus:ring-indigo-600/10 transition-all text-sm">
                        @error('current_password') <span class="text-xs text-rose-500 font-bold mt-2 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-300 uppercase tracking-widest mb-3 ml-1">New Password</label>
                        <input type="password" name="password" required class="w-full px-8 py-4 bg-slate-50 border-transparent rounded-2xl outline-none font-bold text-slate-900 focus:bg-white focus:ring-4 focus:ring-indigo-600/10 transition-all text-sm">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-300 uppercase tracking-widest mb-3 ml-1">Confirm New Password</label>
                        <input type="password" name="password_confirmation" required class="w-full px-8 py-4 bg-slate-50 border-transparent rounded-2xl outline-none font-bold text-slate-900 focus:bg-white focus:ring-4 focus:ring-indigo-600/10 transition-all text-sm">
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-[2rem] font-black text-sm uppercase tracking-widest hover:bg-slate-900 transition-all duration-300 shadow-xl shadow-indigo-100">
                            Update Security
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="p-8 bg-rose-50 rounded-[2.5rem] border border-rose-100">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-rose-600 shadow-sm">
                        <i data-lucide="shield-alert" class="w-5 h-5"></i>
                    </div>
                    <h5 class="font-black text-rose-900 text-sm">Sensitive Actions</h5>
                </div>
                <p class="text-rose-700/60 text-[11px] font-bold leading-relaxed">Changes to your official email or password may require you to re-authenticate for security purposes.</p>
            </div>
        </div>
    </div>
</div>
@endsection
