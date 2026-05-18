<?php

namespace Database\Seeders;

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
            'username' => 'user',
            'users.password' => Hash::make('user123'),
        ]);

        User::query()->create([
            'username' => 'admin',
            'users.password' => Hash::make('admin123'),
            'users.role' => 'ADMIN',
        ]);
    }
}
