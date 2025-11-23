<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreatePelangganDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = \Faker\Factory::create();
        $faker->unique(true);

        foreach (range(1, 1000) as $index) {
            DB::table('pelanggan')->insert([
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
                'birthday'   => $faker->date('Y-m-d', '2005-12-31'),
                'gender'     => $faker->randomElement(['Male', 'Female', 'Other']),
                'email'      => strtolower($faker->userName) . '+' . uniqid() . '@example.com',
                'phone'      => $faker->phoneNumber,
            ]);
        }
    }
}
