<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'syrab',
            'image' => 'Desert.jpg',
        ]);
        DB::table('categories')->insert([
            'name' => 'creams',
            'image' => 'Desert.jpg',
        ]);
        DB::table('categories')->insert([
            'name' => 'suncare',
            'image' => 'Desert.jpg',
        ]);
    }
}
