<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            "penyedia_id" => 1,
            "section_id" => 2,
            "brand_id" => 1,
            "category_id" => 1,
            "type" => "penyedia",
            "nama" => "Product 1",
            "harga" => 15000,
            "diskon" => 10,
            "gambar" => "",
            "video" => "",
            "deskripsi" => "contoh product 1",
            "meta_title" => "contoh",
            "meta_description" => "contoh",
            "meta_keywords" => "contoh",
            "is_featured" => "Yes",
            "status" => 1,
            "admin_id"=> 1
        ]);
    }
}
