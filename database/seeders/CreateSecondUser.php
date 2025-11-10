<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateSecondUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data['name'] = 'Nasywa Azzahro';
        $data['email']  = 'nasywa@pcr.id';
        $data['password']   = Hash::make('nasywaazzahro123');
        User::create($data);
    }
}
