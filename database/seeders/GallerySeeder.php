<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tour;
use App\Models\TourImage;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $tours = Tour::all();
        
        $images = [
            'https://images.unsplash.com/photo-1506461883276-594a12b11cf3?q=80&w=1000',
            'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?q=80&w=1000',
            'https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=1000',
            'https://images.unsplash.com/photo-1472396961693-142e6e269027?q=80&w=1000',
            'https://images.unsplash.com/photo-1470770841072-f978cf4d019e?q=80&w=1000',
            'https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=1000',
        ];

        foreach ($tours as $tour) {
            // Clear existing images to avoid duplicates
            $tour->images()->delete();
            
            foreach ($images as $index => $url) {
                TourImage::create([
                    'tour_id' => $tour->id,
                    'image_path' => $url,
                    'is_featured' => ($index === 0),
                    'sort_order' => $index
                ]);
            }
        }
    }
}
