<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class filterValueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_filter_values')->insert([
            "product_filter_id" => "1",
            "filter_value" => "desain-grafis",
            "status" => 1
        ]);
        DB::table('product_filter_values')->insert([
            "product_filter_id" => "2",
            "filter_value" => "desain-grafis",
            "status" => 1
        ]);
    }
}
