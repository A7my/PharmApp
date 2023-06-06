<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PharmacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('pharmacies')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('pharmacies')->insert(
            [
            'name' => "El Tarshoby",
            'address' => "5th street, Fourth Squre",
            'phone_number' => "01232323232",
            'delivery' => "1",
            'image' => 'D.jpg'
        ]
    );

        DB::table('pharmacies')->insert(
            [
                'name' => "El Shaf3y",
                'address' => "12 shar3 el doctor",
                'phone_number' => "01132313231",
                'delivery' => "0.5",
                'image' => 'D.jpg'
            ]

        );

        DB::table('pharmacies')->insert(
            [
                'name' => "Azhar",
                'address' => "2nd street, El Abbasy",
                'phone_number' => "01231327252",
                'delivery' => "0.5",
                'image' => 'D.jpg'
            ]
        );

        DB::table('pharmacies')->insert(
            [
                'name' => "Abo Zand",
                'address' => "1st street, Shar3 El Ba7r",
                'phone_number' => "01292393239",
                'delivery' => "1.5",
                'image' => 'D.jpg'
            ]
        );
        DB::table('pharmacies')->insert(
            [
                'name' => "Dr.Faheem",
                'address' => "34 El hai el sha3by",
                'phone_number' => "01552525235",
                'delivery' => "1",
                'image' => 'D.jpg'
            ]
        );


    }
}
