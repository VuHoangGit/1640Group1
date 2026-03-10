<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['email' => 'admin@gmail.com', 'password' => Hash::make('admin'), 'role' => 'admin', 'acceptTerms' => true],
            ['email' => 'staff1@gmail.com', 'password' => Hash::make('staff'), 'role' => 'staff', 'acceptTerms' => true]
        ]);
    }
}
