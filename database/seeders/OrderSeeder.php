<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'client_id' => 3,
            'items' => 1,
            'total_price' => 20,
            'address' => '52th Shar3 El-Azhar'
        ]);

        DB::table('orders')->insert([
            'client_id' => 4,
            'items' => 2,
            'total_price' => 50,
            'address' => '5th 7y El-Nakhil'
        ]);


    }
}
