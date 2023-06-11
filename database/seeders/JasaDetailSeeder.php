<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class JasaDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jasa_details')->insert([
            "penyedia_id" => 1,
            "nama_toko" => "ardlicatering",
            "alamat_toko" => "KetilengSingolelo RT.03/RW.04",
            "Kecamatan_toko" => "Welahan",
            "kota_toko" => "Jepara",
            "provinsi_toko" => "Jawa Tengah",
            "kode_pos_toko" => "59464",
        ]);
    }
}
