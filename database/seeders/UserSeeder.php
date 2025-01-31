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
        User::insert(
            [
                [
                    'name'=> 'Admin',
                    'midlename'=> '.',
                    'lastname'=> '.',
                    'login'=> 'adminka',
                    'password'=> Hash::make('password'),
                    'tel'=> '79000889691',
                    'email'=> 'example@mail.com',
                ],
            ]
        );
    }
}
