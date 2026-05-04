<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Adventure', 'icon' => 'mountain'],
            ['name' => 'Cultural & Heritage', 'icon' => 'landmark'],
            ['name' => 'Honeymoon', 'icon' => 'heart'],
            ['name' => 'Religious', 'icon' => 'church'],
            ['name' => 'Beach & Coastal', 'icon' => 'palmtree'],
            ['name' => 'Family Trips', 'icon' => 'users'],
        ];

        foreach ($categories as $cat) {
            \App\Models\Category::create([
                'name' => $cat['name'],
                'slug' => \Illuminate\Support\Str::slug($cat['name']),
                'icon' => $cat['icon'],
            ]);
        }
    }
}
