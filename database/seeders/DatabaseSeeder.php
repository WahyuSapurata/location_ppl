<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'uuid' => Uuid::uuid4()->toString(),
                'name' => 'admin',
                'password' => Hash::make('admin'),
                'role' => 'admin'
            ]
        );
    }
}
