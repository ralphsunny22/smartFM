<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Models\User::create([
            'name' => 'Admin Manager',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $user = \App\Models\User::create([
            'name' => 'Ugo Sunday',
            'email' => 'ugo@gmail.com',
            'password' => Hash::make('password'),
        ]);

        
    }
}