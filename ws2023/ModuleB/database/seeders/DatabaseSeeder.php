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
            'username' => 'demo1',
            'password' => Hash::make('skills2023d1'),
        ]);

        User::query()->create([
            'username' => 'demo2',
            'password' => Hash::make('skills2023d2'),
        ]);

    }
}
