@extends('layouts.app')

@section('title', 'PAK TRAVEL - Luxury Multi-Vendor Travel Marketplace')

@section('content')
    <!-- Hero Section -->
    <x-home.hero />

    <!-- Categories Section -->
    <x-home.categories />

    <!-- Featured Tours Section -->
    <x-home.featured-tours :tours="$tours" />

    <!-- Popular Destinations Section -->
    <x-home.destinations />

    <!-- Why Choose Us Section -->
    <x-home.why-us />

    <!-- Testimonials Section -->
    <x-home.testimonials />

    <!-- Newsletter Section -->
    <x-home.newsletter />
@endsection

@push('scripts')
<script>
    // Intersection Observer for fade-in animations
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    entry.target.classList.remove('opacity-0', 'translate-y-10');
                }
            });
        }, observerOptions);

        // Add reveal class to sections
        document.querySelectorAll('section').forEach(section => {
            if (!section.classList.contains('relative')) { // Skip hero for now or handle differently
                 // section.classList.add('transition-all', 'duration-1000', 'opacity-0', 'translate-y-10');
                 // observer.observe(section);
            }
        });
    });
</script>
@endpush
