<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $dataUsers =[
            [
                'name' => 'Admin 1',
                'email' =>'admin1@rmuti.ac.th',
                'password'=> Hash::make('a123456789'),
                'role'=> 1,
            ],
            [
                'name' => 'tradesman 1',
                'email' =>'tradesman1@rmuti.ac.th',
                'password'=> Hash::make('t123456789'),
                'role'=> 2,
            ]
        ];
        User::insert($dataUsers);

        $dataDepartments=[
            ['department_name' => 'งานบริการทั่วไป'],

        ];

        Department::insert($dataDepartments);



    }
}
