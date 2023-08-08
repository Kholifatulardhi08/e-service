<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RatingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ratings')->insert([
            "user_id" => 1,
            "product_id" => 1,
            "review" => "Bagus banget pelayanannya!",
            "rating" => 5,
            "status" => 1
        ]);
        DB::table('ratings')->insert([
            "user_id" => 1,
            "product_id" => 1,
            "review" => "Bagus tapi pelayanannya!",
            "rating" => 4,
            "status" => 1
        ]);
           
    }
}
