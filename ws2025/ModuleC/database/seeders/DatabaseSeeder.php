<?php

namespace Database\Seeders;

use App\Models\Adverts;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

// ===== User =====

        User::query()->create([
            'name' => 'Ethan Brooks',
            'phone' => '+1 202 555 0143',
            'email' => 'ethan@ws-s17.kz',
            'password' => Hash::make('ethan_123'),
            'role' => 'user',
        ]);

        User::query()->create([
            'name' => 'Olivia Carter',
            'phone' => ' +44 7700 900321',
            'email' => 'olivia@ws-s17.kz',
            'password' => Hash::make('olivia_123'),
            'role' => 'moderator',
        ]);

// ===== Category =====

        Category::query()->create([
            'name' => 'modern'
        ]);

        Category::query()->create([
            'name' => 'business'
        ]);

        Category::query()->create([
            'name' => 'beauty'
        ]);

// ===== Advert =====

        Adverts::query()->create([
            'status' => 'draft',
            'title' => 'test title',
            'text' => 'test text',
            'price' => 12500,
            'category_id' => 1,
            'user_id' => 1,
            'photos' => json_encode(['first.jpg', 'second.jpg', 'third.jpg']),
        ]);

    }
}
