<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        \App\Models\User::create([
            'name' => 'Super Admin',
            'email' => 'admin@paktravels.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
        ]);

        // Vendors
        $vendors = [
            ['name' => 'Ali Raza', 'agency' => 'Northern Travels'],
            ['name' => 'Sarah Khan', 'agency' => 'Sarah Adventures'],
            ['name' => 'Hamza Ali', 'agency' => 'Karakoram Nomads'],
        ];

        foreach ($vendors as $index => $v) {
            $user = \App\Models\User::create([
                'name' => $v['name'],
                'email' => 'vendor' . ($index + 1) . '@paktravels.com',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'vendor',
            ]);

            \App\Models\Vendor::create([
                'user_id' => $user->id,
                'agency_name' => $v['agency'],
                'slug' => \Illuminate\Support\Str::slug($v['agency']),
                'status' => 'active',
            ]);
        }

        // Travelers
        for ($i = 1; $i <= 5; $i++) {
            \App\Models\User::create([
                'name' => 'Traveler ' . $i,
                'email' => 'traveler' . $i . '@gmail.com',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'traveler',
            ]);
        }
    }
}
