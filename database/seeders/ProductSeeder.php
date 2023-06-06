<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //



        Schema::disableForeignKeyConstraints();
        DB::table('products')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('products')->insert([
            'name' => 'Amobarpital',
            'description' => "tablets",
            'price' => "50",
            'quantity' => 10,
            'image' => "d.jpg",
            'category_id' => 1,
            'pharmacy_id' => 1,
        ]);
        DB::table('products')->insert([
            'name' => 'Amodyakon',
            'description' => "Syrab",
            'price' => "178",
            'pharmacy_id' => 3,
            'image' => "d.jpg",
            'category_id' => 2,
            'quantity' => 12
        ]);
        DB::table('products')->insert([
            'name' => 'Aboskanat',
            'description' => "ears cleaner",
            'price' => "50",
            'pharmacy_id' => 5,
            'image' => "d.jpg",
            'category_id' => 3,
            'quantity' => 6
        ]);
        // DB::table('products')->insert([
        //     'name' => 'Amosolalol',
        //     'description' => "eye drop",
        //     'price' => "50",
        //     'pharmacy_id' => 5
        // ]);
        // DB::table('products')->insert([
        //     'name' => 'Antinal',
        //     'description' => "Gut disease",
        //     'price' => "31",
        //     'pharmacy_id' => 3
        // ]);

        // DB::table('products')->insert([
        //     'name' => 'Amoksabene',
        //     'description' => "for colon",
        //     'price' => "33",
        //     'pharmacy_id' => 2
        // ]);

        // DB::table('products')->insert([
        //     'name' => 'Panadol',
        //     'description' => "control temperature",
        //     'price' => "12",
        //     'pharmacy_id' => 4
        // ]);

        // DB::table('products')->insert([
        //     'name' => 'Congestal',
        //     'description' => "control temperature",
        //     'price' => "22",
        //     'pharmacy_id' => 5
        // ]);

        // DB::table('products')->insert([
        //     'name' => 'Abimol Extra',
        //     'description' => "control temperature",
        //     'price' => "12",
        //     'pharmacy_id' => 1
        // ]);


    }
}
