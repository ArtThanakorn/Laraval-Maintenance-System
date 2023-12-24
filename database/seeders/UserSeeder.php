<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin 1',
            'email' =>'admin1@rmuti.ac.th',
            'password'=> Hash::make('a123456789'),
            'role'=> 1,
        ]);

        User::create([
            'name' => 'tradesman 1',
            'email' =>'tradesman1@rmuti.ac.th',
            'password'=> Hash::make('t123456789'),
            'role'=> 2,
        ]);
    }
}
