<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProducAtributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_atributes')->insert([
            "product_id" => 1,
            "paket" => "Paket 1",
            "keterangan" => "Keterangan 1 contoh 1",
            "harga" => "10000",
            "status" => 1,
        ]);
        DB::table('product_atributes')->insert([
            "product_id" => 2,
            "paket" => "Paket 2",
            "keterangan" => "Keterangan 2 contoh 2",
            "harga" => "15000",
            "status" => 0,
        ]);
    }
}
