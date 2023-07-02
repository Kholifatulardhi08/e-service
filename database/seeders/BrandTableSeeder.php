<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->insert([
            "nama" => "brand 1",
            "status" => 1
        ]);
        DB::table('brands')->insert([
            "nama" => "brand 2",
            "status" => 0
        ]);
        DB::table('brands')->insert([
            "nama" => "brand 3",
            "status" => 1
        ]);
    }
}
