<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenyediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penyedias')->insert([
            "nama" => "Kholifard",
            "alamat" => "Ketileng singolelo RT.03/RW.04",
            "kecamatan" => "Welahan",
            "no_hp" => "081225755325",
            "kota" => "Jepara",
            "provinsi" => "Jawa Tengah",
            "email" => "kholifard@gmail.com",
            "status" => 1
        ]);
    }
}
