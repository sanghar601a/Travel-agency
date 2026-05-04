<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tour extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'vendor_id', 'category_id', 'title', 'slug', 'description', 
        'base_price', 'duration_days', 'location', 'featured_image', 'max_guests', 'status'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function itineraries()
    {
        return $this->hasMany(TourItinerary::class)->orderBy('day_number');
    }

    public function images()
    {
        return $this->hasMany(TourImage::class)->orderBy('sort_order');
    }

    public function departures()
    {
        return $this->hasMany(TourDeparture::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->latest();
    }

    public function featuredImage()
    {
        if (!empty($this->featured_image)) {
            // Check if it's already a full URL (e.g. from an old seeder or absolute URL)
            if (filter_var($this->featured_image, FILTER_VALIDATE_URL)) {
                return $this->featured_image;
            }
            // Check if it's a dummy image from public/images
            if (\Illuminate\Support\Str::startsWith($this->featured_image, 'images/')) {
                return asset($this->featured_image);
            }
            return asset('storage/' . $this->featured_image);
        }
        
        $featured = $this->images()->where('is_featured', true)->first();
        if ($featured) {
            if (\Illuminate\Support\Str::startsWith($featured->image_path, 'http')) {
                return $featured->image_path;
            }
            return asset($featured->image_path);
        }
        
        return 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&q=80&w=1200';
    }
}
