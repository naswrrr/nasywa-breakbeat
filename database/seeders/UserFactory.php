<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\User;

class UserFactory extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
       // Buat 1000 user lainnya
        for ($i = 0; $i < 1000; $i++) {
            User::create([
                'name' => $faker->firstName . ' ' . $faker->lastName,
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password123'),
                'role' => $faker->randomElement(['admin', 'pegawai']),
                'status' => $faker->randomElement(['active', 'inactive']),
            ]);
        }

        // Reset faker unique cache
        $faker->unique(true);
    }
}
