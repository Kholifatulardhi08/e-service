<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            "parent_id" => 0,
            "section_id" => 4,
            "nama" => "Pernikahan",
            "image" => "",
            "diskon" => 0,
            "deskripsi" => "",
            "url" => "wedding",
            "meta_title" => "",
            "meta_description" => "",
            "meta_keyword" => "",
            "status" => 1,
        ]);
        DB::table('categories')->insert([
            "parent_id" => 0,
            "section_id" => 5,
            "nama" => "Pertukangan",
            "image" => "",
            "diskon" => 0,
            "deskripsi" => "",
            "url" => "tukang",
            "meta_title" => "",
            "meta_description" => "",
            "meta_keyword" => "",
            "status" => 1,
        ]);
    }
}
