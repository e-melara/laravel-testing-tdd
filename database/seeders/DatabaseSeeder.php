<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::factory()->create([
            "name" => "Test User",
            "email" => "test@test.com",
        ]);

        \App\Models\User::factory()->create([
            "name" => "Test User 2",
            "email" => "info@test.com",
        ]);
    }
}
