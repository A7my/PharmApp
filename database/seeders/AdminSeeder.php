<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => "admin@admin.com",
            'password' => Hash::make('11111111'),
            'role' => 'admin',
            'phone_number' => '121211',
            'address' => '55yth'
        ]);
        DB::table('users')->insert([
            'name' => 'delivery1',
            'email' => "delivery1@delivery.com",
            'password' => Hash::make('11111111'),
            'role' => 'd.man',
            'phone_number' => '1221211',
            'address' => '55yth'
        ]);
        DB::table('users')->insert([
            'name' => 'user1',
            'email' => "user1@user.com",
            'password' => Hash::make('11111111'),
            'role' => 'client',
            'phone_number' => '12121111',
            'address' => '55yth'
        ]);
        DB::table('users')->insert([
            'name' => 'user2',
            'email' => "user2@user.com",
            'password' => Hash::make('11111111'),
            'role' => 'client',
            'phone_number' => '912121111',
            'address' => '55yth'
        ]);
    }
}
