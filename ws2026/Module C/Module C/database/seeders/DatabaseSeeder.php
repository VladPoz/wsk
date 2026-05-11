<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'name' => 'user',
            'password' => 'user123',
        ]);
        User::query()->create([
            'name' => 'admin',
            'password' => 'admin123',
            'role' => 'ADMIN',
        ]);

        Category::query()->create([
            'name' => 'category_1',
        ]);
        Category::query()->create([
            'name' => 'category_2',
        ]);
        Category::query()->create([
            'name' => 'category_3',
        ]);
        Category::query()->create([
            'name' => 'category_4',
        ]);
        Category::query()->create([
            'name' => 'category_5',
        ]);
        Category::query()->create([
            'name' => 'category_6',
        ]);
        Category::query()->create([
            'name' => 'category_7',
        ]);
        Category::query()->create([
            'name' => 'category_8',
        ]);
    }
}
