<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = \App\Models\Vendor::all();
        $categories = \App\Models\Category::all();

        $tours = [
            [
                'title' => 'Hunza Valley & Attabad Lake Adventure',
                'description' => 'Experience the breathtaking beauty of Hunza Valley, visit Altit and Baltit forts, and enjoy a boat ride on the crystal clear Attabad Lake.',
                'price' => 45000,
                'days' => 5,
                'location' => 'Hunza, Gilgit Baltistan',
                'img' => 'https://images.unsplash.com/photo-1627894006066-b452243d3765?q=80&w=1000'
            ],
            [
                'title' => 'Skardu & Shangrila Resort Getaway',
                'description' => 'A luxury trip to the heart of Baltistan. Visit the famous Shangrila Resort, Lower Kachura Lake, and the majestic Deosai Plains.',
                'price' => 55000,
                'days' => 6,
                'location' => 'Skardu, Baltistan',
                'img' => 'https://images.unsplash.com/photo-1581454552431-75df157e80d2?q=80&w=1000'
            ],
            [
                'title' => 'Swat Valley Cultural Tour',
                'description' => 'Explore the Switzerland of the East. Visit Kalam, Malam Jabba, and the ancient Buddhist sites in Swat.',
                'price' => 35000,
                'days' => 4,
                'location' => 'Swat, KPK',
                'img' => 'https://images.unsplash.com/photo-1622321481146-52869df91000?q=80&w=1000'
            ],
            [
                'title' => 'Naran & Kaghan Valley Expedition',
                'description' => 'Visit the legendary Saif-ul-Malook Lake, Babusar Top, and the lush green meadows of Naran valley.',
                'price' => 32000,
                'days' => 3,
                'location' => 'Naran, KPK',
                'img' => 'https://images.unsplash.com/photo-1549414594-e3c3b52d9217?q=80&w=1000'
            ],
            [
                'title' => 'Neelum Valley AJK Paradise',
                'description' => 'Discover the hidden gems of Azad Kashmir. Visit Keran, Sharda, and the stunning Arang Kel.',
                'price' => 38000,
                'days' => 5,
                'location' => 'Neelum Valley, AJK',
                'img' => 'https://images.unsplash.com/photo-1623150536480-1a13437e6988?q=80&w=1000'
            ]
        ];

        foreach ($tours as $t) {
            $tour = \App\Models\Tour::create([
                'vendor_id' => $vendors->random()->id,
                'category_id' => $categories->random()->id,
                'title' => $t['title'],
                'slug' => \Illuminate\Support\Str::slug($t['title']),
                'description' => $t['description'],
                'base_price' => $t['price'],
                'duration_days' => $t['days'],
                'location' => $t['location'],
                'featured_image' => $t['img'],
                'status' => 'active',
                'max_guests' => 12,
            ]);

            // Create departures
            \App\Models\TourDeparture::create([
                'tour_id' => $tour->id,
                'start_date' => now()->addDays(rand(10, 20)),
                'end_date' => now()->addDays(rand(10, 20) + $tour->duration_days),
                'available_seats' => 12,
                'status' => 'open',
            ]);

            \App\Models\TourDeparture::create([
                'tour_id' => $tour->id,
                'start_date' => now()->addDays(rand(25, 40)),
                'end_date' => now()->addDays(rand(25, 40) + $tour->duration_days),
                'available_seats' => 12,
                'status' => 'open',
            ]);
        }
    }
}
