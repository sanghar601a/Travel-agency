@extends('layouts.vendor', ['active' => 'packages'])

@section('header_title', 'Package Builder')

@section('content')
<div class="h-full">
    <form action="{{ isset($tour) ? route('vendor.packages.update', $tour->id) : route('vendor.packages.store') }}" method="POST" enctype="multipart/form-data" class="h-full flex flex-col">
        @csrf
        @if(isset($tour))
            @method('PUT')
        @endif

        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">{{ isset($tour) ? 'Edit Package: ' . $tour->title : 'Create New Package' }}</h2>
                <p class="text-slate-500 mt-1 font-medium">{{ isset($tour) ? 'Update your tour details below.' : 'Fill in the details to list your tour on PAK TRAVEL marketplace.' }}</p>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('vendor.tours') }}" class="px-6 py-3 bg-white text-slate-600 rounded-xl font-bold hover:bg-slate-50 transition-all border border-slate-200 shadow-sm flex items-center gap-2">
                    <i data-lucide="x" class="w-4 h-4"></i> Cancel
                </a>
                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-bold shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-0.5 transition-all flex items-center gap-2">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                    {{ isset($tour) ? 'Save Changes' : 'Publish Tour' }}
                </button>
            </div>
        </div>

        <!-- Premium Single-Page Grid Layout -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 pb-8">
            
            <!-- Left Column: Primary Details -->
            <div class="xl:col-span-2 space-y-6">
                <div class="bg-white rounded-[2rem] p-8 premium-shadow border border-slate-100 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-indigo-500"></div>
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center shadow-sm">
                            <i data-lucide="file-text" class="w-5 h-5"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">Package Details</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Tour Title <span class="text-rose-500">*</span></label>
                            <input type="text" name="title" value="{{ old('title', $tour->title ?? '') }}" placeholder="e.g. 10 Days Karakoram Highway Adventure" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-base font-bold text-slate-900" required>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Category <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <select name="category_id" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none appearance-none font-bold text-slate-700" required>
                                    <option value="" disabled {{ !isset($tour) ? 'selected' : '' }}>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ (old('category_id', $tour->category_id ?? '') == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Location <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <i data-lucide="map-pin" class="w-4 h-4 text-slate-400 absolute left-5 top-1/2 -translate-y-1/2"></i>
                                <input type="text" name="location" value="{{ old('location', $tour->location ?? '') }}" placeholder="e.g. Hunza Valley" class="w-full pl-12 pr-5 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none font-bold text-slate-700" required>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Description <span class="text-rose-500">*</span></label>
                            <textarea name="description" rows="5" placeholder="Provide a captivating description of the tour experience..." class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none font-medium text-slate-700 resize-none leading-relaxed" required>{{ old('description', $tour->description ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Settings & Media -->
            <div class="space-y-6">
                <!-- Pricing & Config -->
                <div class="bg-white rounded-[2rem] p-8 premium-shadow border border-slate-100 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-400 to-teal-500"></div>
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center shadow-sm">
                            <i data-lucide="tag" class="w-5 h-5"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">Pricing & Setup</h3>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Base Price (Per Person) <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 font-black text-lg">$</span>
                                <input type="number" name="base_price" value="{{ old('base_price', $tour->base_price ?? '') }}" placeholder="0.00" class="w-full pl-10 pr-5 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none font-black text-slate-900 text-xl" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Duration <span class="text-rose-500">*</span></label>
                                <div class="relative">
                                    <input type="number" name="duration_days" value="{{ old('duration_days', $tour->duration_days ?? '') }}" placeholder="Days" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none font-bold text-slate-700" required>
                                    <span class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-xs">Days</span>
                                </div>
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Max Capacity</label>
                                <div class="relative">
                                    <i data-lucide="users" class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                                    <input type="number" name="max_guests" value="{{ old('max_guests', $tour->max_guests ?? '') }}" placeholder="12" class="w-full pl-11 pr-4 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none font-bold text-slate-700">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Media -->
                <div class="bg-white rounded-[2rem] p-8 premium-shadow border border-slate-100 relative overflow-hidden" x-data="{ imageUrl: '{{ isset($tour) ? $tour->featuredImage() : '' }}' }">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 to-pink-500"></div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center shadow-sm">
                            <i data-lucide="image" class="w-5 h-5"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">Media Gallery</h3>
                    </div>
                    
                    <label class="border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center p-6 text-center group hover:border-purple-500 hover:bg-purple-50/30 transition-all cursor-pointer relative overflow-hidden min-h-[200px] @error('image') border-rose-500 bg-rose-50/30 @enderror">
                        <input type="file" name="image" class="hidden" accept="image/*" @change="handleImageUpload($event.target).then(res => { if(res) imageUrl = URL.createObjectURL($event.target.files[0]) })">
                        
                        <div x-show="!imageUrl" class="flex flex-col items-center justify-center" x-cloak>
                            <div class="w-12 h-12 bg-white shadow-sm text-slate-400 rounded-full flex items-center justify-center mb-3 group-hover:text-purple-600 group-hover:scale-110 transition-all">
                                <i data-lucide="upload-cloud" class="w-6 h-6"></i>
                            </div>
                            <h4 class="text-sm font-bold text-slate-900 mb-1">Upload Cover Photo</h4>
                            <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">JPG, PNG (Max 2MB)</p>
                        </div>

                        <div x-show="imageUrl" class="absolute inset-0 w-full h-full" x-cloak>
                            <img :src="imageUrl" class="w-full h-full object-cover" alt="Cover Preview">
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="text-white font-bold flex items-center gap-2 bg-black/50 px-4 py-2 rounded-full backdrop-blur-sm">
                                    <i data-lucide="refresh-cw" class="w-4 h-4"></i> Change Image
                                </span>
                            </div>
                        </div>
                    </label>
                    @error('image')
                        <p class="mt-2 text-xs font-bold text-rose-500">{{ $message }}</p>
                    @enderror

                    <!-- Gallery Images Upload -->
                    <div class="mt-6">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Gallery Images</label>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Image 1 -->
                            <label class="border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center p-4 text-center group hover:border-blue-500 hover:bg-blue-50/30 transition-all cursor-pointer relative overflow-hidden min-h-[160px] @error('gallery_image_1') border-rose-500 bg-rose-50/30 @enderror" x-data="{ imageUrl: '{{ isset($tour) && $tour->images->where('is_featured', false)->count() > 0 ? (Str::startsWith($tour->images->where('is_featured', false)->first()->image_path, 'http') ? $tour->images->where('is_featured', false)->first()->image_path : asset($tour->images->where('is_featured', false)->first()->image_path)) : '' }}' }">
                                <input type="file" name="gallery_image_1" class="hidden" accept="image/*" @change="handleImageUpload($event.target).then(res => { if(res) imageUrl = URL.createObjectURL($event.target.files[0]) })">
                                
                                <div x-show="!imageUrl" class="flex flex-col items-center justify-center" x-cloak>
                                    <div class="w-10 h-10 bg-white shadow-sm text-slate-400 rounded-full flex items-center justify-center mb-3 group-hover:text-blue-600 group-hover:scale-110 transition-all">
                                        <i data-lucide="image-plus" class="w-5 h-5"></i>
                                    </div>
                                    <h4 class="text-xs font-bold text-slate-900 mb-1">Gallery Image 1</h4>
                                </div>

                                <div x-show="imageUrl" class="absolute inset-0 w-full h-full" x-cloak>
                                    <img :src="imageUrl" class="w-full h-full object-cover" alt="Gallery 1 Preview">
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <span class="text-white font-bold text-xs flex items-center gap-1 bg-black/50 px-3 py-1.5 rounded-full backdrop-blur-sm">
                                            <i data-lucide="refresh-cw" class="w-3 h-3"></i> Change
                                        </span>
                                    </div>
                                </div>
                            </label>

                            <!-- Image 2 -->
                            <label class="border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center p-4 text-center group hover:border-blue-500 hover:bg-blue-50/30 transition-all cursor-pointer relative overflow-hidden min-h-[160px] @error('gallery_image_2') border-rose-500 bg-rose-50/30 @enderror" x-data="{ imageUrl: '{{ isset($tour) && $tour->images->where('is_featured', false)->count() > 1 ? (Str::startsWith($tour->images->where('is_featured', false)->skip(1)->first()->image_path, 'http') ? $tour->images->where('is_featured', false)->skip(1)->first()->image_path : asset($tour->images->where('is_featured', false)->skip(1)->first()->image_path)) : '' }}' }">
                                <input type="file" name="gallery_image_2" class="hidden" accept="image/*" @change="handleImageUpload($event.target).then(res => { if(res) imageUrl = URL.createObjectURL($event.target.files[0]) })">
                                
                                <div x-show="!imageUrl" class="flex flex-col items-center justify-center" x-cloak>
                                    <div class="w-10 h-10 bg-white shadow-sm text-slate-400 rounded-full flex items-center justify-center mb-3 group-hover:text-blue-600 group-hover:scale-110 transition-all">
                                        <i data-lucide="image-plus" class="w-5 h-5"></i>
                                    </div>
                                    <h4 class="text-xs font-bold text-slate-900 mb-1">Gallery Image 2</h4>
                                </div>

                                <div x-show="imageUrl" class="absolute inset-0 w-full h-full" x-cloak>
                                    <img :src="imageUrl" class="w-full h-full object-cover" alt="Gallery 2 Preview">
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <span class="text-white font-bold text-xs flex items-center gap-1 bg-black/50 px-3 py-1.5 rounded-full backdrop-blur-sm">
                                            <i data-lucide="refresh-cw" class="w-3 h-3"></i> Change
                                        </span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    async function handleImageUpload(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            
            // If file is already small (< 500KB), don't compress
            if (file.size < 512 * 1024) return true;

            // Show loading toast
            Swal.fire({
                title: 'Optimizing Image...',
                text: 'Please wait while we compress your image for faster upload.',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            try {
                const options = {
                    maxSizeMB: 1,
                    maxWidthOrHeight: 1920,
                    useWebWorker: true,
                    initialQuality: 0.8
                };
                
                const compressedFile = await imageCompression(file, options);
                
                // Replace the file in input
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(new File([compressedFile], file.name, { type: file.type }));
                input.files = dataTransfer.files;
                
                Swal.close();
                return true;
            } catch (error) {
                console.error(error);
                Swal.fire('Optimization Error', 'Could not compress image, using original file.', 'warning');
                return true; // Still allow upload if compression fails
            }
        }
        return true;
    }
</script>
@endpush
