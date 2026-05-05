<?php

namespace Database\Seeders;

use App\Models\Advert;
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
        // User::factory(10)->create();

        User::query()->create([
            'name' => 'Ethan Brooks',
            'phone' => '+1 202 555 0143',
            'email' => 'ethan@example.com',
            'password' => Hash::make('ethan_123'),
            'role' => 'user',
        ]);
        User::query()->create([
            'name' => 'Olivia Carter',
            'phone' => '+44 7700 900321',
            'email' => 'olivia@example.com',
            'password' => Hash::make('olivia_123'),
            'role' => 'moderator',
        ]);

        Category::query()->create([
            'name' => 'Real Estate',
        ]);
        Category::query()->create([
            'name' => 'Vehicles',
        ]);
        Category::query()->create([
            'name' => 'Jobs',
        ]);
        Category::query()->create([
            'name' => 'Services',
        ]);
        Category::query()->create([
            'name' => 'Electronics',
        ]);
        Category::query()->create([
            'name' => 'Personal Items',
        ]);
        Category::query()->create([
            'name' => 'Hobbies & Leisure',
        ]);
        Category::query()->create([
            'name' => 'Animals & Pets',
        ]);
        Category::query()->create([
            'name' => 'Home & Garden',
        ]);
        Category::query()->create([
            'name' => 'Business & Equipment',
        ]);

        Advert::query()->create([
            'title' => 'Modern Apartment in City Center',
            'text' => 'Spacious 2-bedroom apartment with great view.',
            'status' => 'published',
            'price' => 1200,
            'views_count' => 256,
            'category_id' => 1,
            'user_id' => 1,
            'photos' => "[\"advert-1.jpg\",\"advert-2.jpg\"]",
            'paid_services' => "[\"top\",\"vip\"]",
        ]);
        Advert::query()->create([
            'title' => 'Cozy Suburban House',
            'text' => 'Quiet area, 3 bedrooms, renovated kitchen.',
            'status' => 'declined',
            'price' => 980,
            'views_count' => 143,
            'category_id' => 5,
            'user_id' => 2,
            'photos' => "[\"advert-1.jpg\",\"advert-2.jpg\",\"advert-3.jpg\"]",
            'paid_services' => "[]",
        ]);
        Advert::query()->create([
            'title' => '8',
            'text' => 'Quiet area, 3 bedrooms, renovated kitchen.',
            'status' => 'published',
            'price' => 912,
            'views_count' => 142,
            'category_id' => 5,
            'user_id' => 2,
            'photos' => "[\"advert-1.jpg\",\"advert-2.jpg\",\"advert-3.jpg\"]",
            'paid_services' => "[]",
        ]);
        Advert::query()->create([
            'title' => '7',
            'text' => 'Quiet area, 3 bedrooms, renovated kitchen.',
            'status' => 'published',
            'price' => 901,
            'views_count' => 141,
            'category_id' => 5,
            'user_id' => 2,
            'photos' => "[\"advert-1.jpg\",\"advert-2.jpg\",\"advert-3.jpg\"]",
            'paid_services' => "[]",
        ]);
        Advert::query()->create([
            'title' => '6',
            'text' => 'Quiet area, 3 bedrooms, renovated kitchen.',
            'status' => 'published',
            'price' => 900,
            'views_count' => 140,
            'category_id' => 5,
            'user_id' => 2,
            'photos' => "[\"advert-1.jpg\",\"advert-2.jpg\",\"advert-3.jpg\"]",
            'paid_services' => "[]",
        ]);
        Advert::query()->create([
            'title' => '5',
            'text' => 'Quiet area, 3 bedrooms, renovated kitchen.',
            'status' => 'published',
            'price' => 870,
            'views_count' => 139,
            'category_id' => 5,
            'user_id' => 2,
            'photos' => "[\"advert-1.jpg\",\"advert-2.jpg\",\"advert-3.jpg\"]",
            'paid_services' => "[]",
        ]);
        Advert::query()->create([
            'title' => '4',
            'text' => 'Quiet area, 3 bedrooms, renovated kitchen.',
            'status' => 'published',
            'price' => 850,
            'views_count' => 138,
            'category_id' => 5,
            'user_id' => 2,
            'photos' => "[\"advert-1.jpg\",\"advert-2.jpg\",\"advert-3.jpg\"]",
            'paid_services' => "[]",
        ]);
        Advert::query()->create([
            'title' => '3',
            'text' => 'Quiet area, 3 bedrooms, renovated kitchen.',
            'status' => 'published',
            'price' => 830,
            'views_count' => 137,
            'category_id' => 5,
            'user_id' => 2,
            'photos' => "[\"advert-1.jpg\",\"advert-2.jpg\",\"advert-3.jpg\"]",
            'paid_services' => "[]",
        ]);
        Advert::query()->create([
            'title' => '2',
            'text' => 'Quiet area, 3 bedrooms, renovated kitchen.',
            'status' => 'published',
            'price' => 800,
            'views_count' => 136,
            'category_id' => 5,
            'user_id' => 2,
            'photos' => "[\"advert-1.jpg\",\"advert-2.jpg\",\"advert-3.jpg\"]",
            'paid_services' => "[]",
        ]);
        Advert::query()->create([
            'title' => '1',
            'text' => 'Quiet area, 3 bedrooms, renovated kitchen.',
            'status' => 'published',
            'price' => 790,
            'views_count' => 135,
            'category_id' => 5,
            'user_id' => 2,
            'photos' => "[\"advert-1.jpg\",\"advert-2.jpg\",\"advert-3.jpg\"]",
            'paid_services' => "[]",
        ]);
        Advert::query()->create([
            'title' => '0',
            'text' => 'Quiet area, 3 bedrooms, renovated kitchen.',
            'status' => 'published',
            'price' => 750,
            'views_count' => 134,
            'category_id' => 5,
            'user_id' => 2,
            'photos' => "[\"advert-1.jpg\",\"advert-2.jpg\",\"advert-3.jpg\"]",
            'paid_services' => "[]",
        ]);
        Advert::query()->create([
            'title' => '-1',
            'text' => 'Quiet area, 3 bedrooms, renovated kitchen.',
            'status' => 'published',
            'price' => 730,
            'views_count' => 133,
            'category_id' => 5,
            'user_id' => 2,
            'photos' => "[\"advert-1.jpg\",\"advert-2.jpg\",\"advert-3.jpg\"]",
            'paid_services' => "[]",
        ]);
        Advert::query()->create([
            'title' => '-2',
            'text' => 'Quiet area, 3 bedrooms, renovated kitchen.',
            'status' => 'published',
            'price' => 710,
            'views_count' => 132,
            'category_id' => 5,
            'user_id' => 2,
            'photos' => "[\"advert-1.jpg\",\"advert-2.jpg\",\"advert-3.jpg\"]",
            'paid_services' => "[]",
        ]);
        Advert::query()->create([
            'title' => '-3',
            'text' => 'Quiet area, 3 bedrooms, renovated kitchen.',
            'status' => 'published',
            'price' => 700,
            'views_count' => 131,
            'category_id' => 5,
            'user_id' => 2,
            'photos' => "[\"advert-1.jpg\",\"advert-2.jpg\",\"advert-3.jpg\"]",
            'paid_services' => "[]",
        ]);
    }
}
