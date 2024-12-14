<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Test seeder.
        UserFactory::new()->createOneQuietly([
            'name' => 'John Doe',
            'email' => 'developer@test.nl',
        ]);
    }
}
