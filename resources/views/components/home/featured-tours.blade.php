@props(['tours' => []])
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-blue-600 font-bold tracking-widest uppercase text-sm">Most Popular</span>
            <h2 class="text-4xl font-bold text-slate-900 mt-2">Featured Tour Packages</h2>
            <div class="w-20 h-1 bg-blue-600 mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($tours as $tour)
            <x-tour-card 
                title="{{ $tour->title }}"
                location="{{ $tour->location }}"
                price="{{ number_format($tour->base_price) }}"
                duration="{{ $tour->duration_days }} Days"
                image="{{ $tour->featuredImage() }}"
                badge="Top Rated"
                badgeColor="bg-blue-600"
                slug="{{ $tour->slug }}"
                id="{{ $tour->id }}"
            />
            @empty
            <x-tour-card 
                title="Majestic Heritage & Royal Culture"
                location="Agra, India"
                price="1,299"
                duration="7 Days"
                image="https://images.unsplash.com/photo-1548013146-72479768bada?auto=format&fit=crop&q=80&w=800"
                badge="Top Rated"
                badgeColor="bg-blue-600"
            />

            <x-tour-card 
                title="Hunza Valley & Karakoram Peaks"
                location="Hunza, Pakistan"
                price="899"
                duration="10 Days"
                image="https://images.unsplash.com/photo-1534067783941-51c9c23ecefd?auto=format&fit=crop&q=80&w=800"
                badge="Best Seller"
                badgeColor="bg-emerald-600"
            />

            <x-tour-card 
                title="Azure Escape & Aegean Sunsets"
                location="Santorini, Greece"
                price="2,499"
                duration="5 Days"
                image="https://images.unsplash.com/photo-1613395877344-13d4a8e0d49e?auto=format&fit=crop&q=80&w=800"
                badge="Honeymoon"
                badgeColor="bg-rose-600"
            />
            @endforelse
        </div>

        <div class="text-center mt-16">
            <a href="{{ route('tours') }}" class="inline-block px-10 py-4 border-2 border-slate-200 text-slate-700 rounded-full font-bold hover:bg-slate-900 hover:text-white hover:border-slate-900 transition-all">
                Explore All Packages
            </a>
        </div>
    </div>
</section>
