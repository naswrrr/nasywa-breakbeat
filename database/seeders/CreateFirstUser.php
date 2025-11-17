<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(1000)->create();

        User::create([
            'name'     => 'Zarro',
            'email'    => 'nasywa@gmail.com',
            'password' => Hash::make('Nasywa123'),
        ]);
    }
}
