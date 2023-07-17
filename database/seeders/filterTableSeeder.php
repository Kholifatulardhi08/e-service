<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class filterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_filters')->insert([
            "cat_id" => "1,2,3,4,5,6,7,8",
            "filter_nama" => "pernikahan",
            "filter_column" => "pernikahan",
            "status" => 1
        ]);
        DB::table('product_filters')->insert([
            "cat_id" => "2,3,4,5",
            "filter_nama" => "desain-grafis",
            "filter_column" => "desain_grafis",
            "status" => 1
        ]);
    }
}
