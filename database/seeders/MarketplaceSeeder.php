<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Category;
use App\Models\Tour;
use App\Models\TourImage;
use App\Models\TourDeparture;
use Illuminate\Support\Str;

class MarketplaceSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@paktravel.pk',
            'password' => bcrypt('password'),
            'role' => User::ROLE_ADMIN,
        ]);

        // Create Vendor
        $vendorUser = User::create([
            'name' => 'Royal Travels',
            'email' => 'vendor@royaltravels.pk',
            'password' => bcrypt('password'),
            'role' => User::ROLE_VENDOR,
        ]);

        $vendor = Vendor::create([
            'user_id' => $vendorUser->id,
            'company_name' => 'Royal Travels Ltd.',
            'slug' => 'royal-travels',
            'is_verified' => true,
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Adventure', 'slug' => 'adventure'],
            ['name' => 'Religious', 'slug' => 'religious'],
            ['name' => 'Family', 'slug' => 'family'],
            ['name' => 'Honeymoon', 'slug' => 'honeymoon'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Create Tours
        $adventure = Category::where('slug', 'adventure')->first();
        
        $tour = Tour::create([
            'vendor_id' => $vendor->id,
            'category_id' => $adventure->id,
            'title' => 'Skardu & Hunza Expedition',
            'slug' => 'skardu-hunza-expedition',
            'description' => 'A luxury adventure tour to the heart of the Karakoram range.',
            'location' => 'Gilgit Baltistan',
            'duration_days' => 10,
            'base_price' => 1250,
            'max_guests' => 12,
            'status' => 'active',
        ]);

        TourImage::create([
            'tour_id' => $tour->id,
            'image_path' => 'https://images.unsplash.com/photo-1589308078059-be1415eab4c3?auto=format&fit=crop&q=80&w=2070',
            'is_featured' => true,
        ]);

        TourDeparture::create([
            'tour_id' => $tour->id,
            'start_date' => '2026-05-15',
            'end_date' => '2026-05-25',
            'total_seats' => 12,
            'available_seats' => 8,
        ]);
    }
}
