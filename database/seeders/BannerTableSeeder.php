<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('banners')->insert([
            "gambar" => "",
            "link" => "Banner-1",
            "title" => "Banner-1",
            "alt" => "Banner",
            "status" => 1
        ]);
    }
}
