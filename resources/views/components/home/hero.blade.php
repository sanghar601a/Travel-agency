<section class="relative min-h-[90vh] flex items-center pt-20 overflow-hidden">
    <!-- Hero Background -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&q=80&w=2073" alt="Travel Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-[2px]"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/60 via-transparent to-slate-50"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white mb-6 tracking-tight">
                Discover the World's <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400">Hidden Treasures</span>
            </h1>
            <p class="text-xl text-white/90 max-w-2xl mx-auto font-light leading-relaxed">
                Experience luxury travel like never before. From the peaks of Karakoram to the shores of the Mediterranean.
            </p>
        </div>

        <!-- Smart Search Engine -->
        <div class="max-w-5xl mx-auto">
            <div class="bg-white/90 backdrop-blur-2xl p-4 md:p-6 rounded-[2rem] premium-shadow border border-white/50">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 md:divide-x divide-slate-200">
                    <!-- Destination -->
                    <div class="px-4 py-2 space-y-1">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-slate-400">Destination</label>
                        <div class="flex items-center gap-3">
                            <i data-lucide="map-pin" class="w-5 h-5 text-blue-600"></i>
                            <input type="text" placeholder="Where are you going?" class="w-full bg-transparent border-none focus:ring-0 text-slate-800 font-semibold placeholder:text-slate-400">
                        </div>
                    </div>

                    <!-- Date -->
                    <div class="px-4 py-2 space-y-1">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-slate-400">Date Range</label>
                        <div class="flex items-center gap-3">
                            <i data-lucide="calendar" class="w-5 h-5 text-blue-600"></i>
                            <input type="text" placeholder="Add dates" class="w-full bg-transparent border-none focus:ring-0 text-slate-800 font-semibold placeholder:text-slate-400">
                        </div>
                    </div>

                    <!-- Budget -->
                    <div class="px-4 py-2 space-y-1">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-slate-400">Budget Range</label>
                        <div class="flex items-center gap-3">
                            <i data-lucide="banknote" class="w-5 h-5 text-blue-600"></i>
                            <select class="w-full bg-transparent border-none focus:ring-0 text-slate-800 font-semibold appearance-none">
                                <option>Economy</option>
                                <option>Standard</option>
                                <option>Luxury</option>
                                <option>Premium Plus</option>
                            </select>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="flex items-center justify-center p-2">
                        <button onclick="window.location='/tours'" class="w-full h-full bg-blue-600 hover:bg-blue-700 text-white rounded-2xl flex items-center justify-center gap-2 transition-all duration-300 premium-shadow group">
                            <i data-lucide="search" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                            <span class="font-bold">Search Now</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Quick Filters -->
            <div class="flex flex-wrap justify-center gap-4 mt-8">
                <button class="glass px-6 py-2 rounded-full text-slate-800 text-sm font-medium hover:bg-white hover:text-blue-600 transition-all">#Adventure</button>
                <button class="glass px-6 py-2 rounded-full text-slate-800 text-sm font-medium hover:bg-white hover:text-blue-600 transition-all">#Honeymoon</button>
                <button class="glass px-6 py-2 rounded-full text-slate-800 text-sm font-medium hover:bg-white hover:text-blue-600 transition-all">#Family</button>
                <button class="glass px-6 py-2 rounded-full text-slate-800 text-sm font-medium hover:bg-white hover:text-blue-600 transition-all">#Religious</button>
            </div>
        </div>
    </div>
</section>
