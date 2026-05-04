<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Category;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $query = Tour::where('status', 'active')->whereHas('vendor', function($q) {
            $q->where('status', 'active');
        });

        // Search Filter
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
            });
        }

        // Category Filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Sorting Logic
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('base_price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('base_price', 'desc');
                break;
            case 'popular':
                $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc');
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }

        $tours = $query->paginate(12);
        $categories = \App\Models\Category::all();

        return view('frontend.pages.tours', compact('tours', 'categories'));
    }

    public function show($slug)
    {
        $tour = Tour::with(['category', 'vendor', 'images', 'departures', 'reviews.user'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.pages.tour-detail', compact('tour'));
    }
}
