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
            "provinsi" => "JAWA TENGAH",
            "email" => "kholifard@gmail.com",
            "status" => 1
        ]);
        // DB::table('penyedias')->insert([
        //     "nama" => "Oase Indonesia",
        //     "alamat" => "Semarang kota RT.03/RW.04",
        //     "kecamatan" => "",
        //     "no_hp" => "081225755325",
        //     "kota" => "Semarang",
        //     "provinsi" => "JAWA TENGAH",
        //     "email" => "oase@gmail.com",
        //     "status" => 1
        // ]);
        // DB::table('penyedias')->insert([
        //     "nama" => "Kreasinova photo studio",
        //     "alamat" => "Magelang kota RT.03/RW.04",
        //     "kecamatan" => "",
        //     "no_hp" => "081225755325",
        //     "kota" => "Magelang",
        //     "provinsi" => "JAWA TENGAH",
        //     "email" => "Kreasinovaphotostudio@gmail.com",
        //     "status" => 1
        // ]);
        // DB::table('penyedias')->insert([
        //     "nama" => "Cv. Surya Perdana",
        //     "alamat" => "Magelang kota RT.03/RW.04",
        //     "kecamatan" => "",
        //     "no_hp" => "081225755325",
        //     "kota" => "Semarang",
        //     "provinsi" => "JAWA TENGAH",
        //     "email" => "suryaperdana@gmail.com",
        //     "status" => 1
        // ]);
        // DB::table('penyedias')->insert([
        //     "nama" => "Arwa Batik",
        //     "alamat" => "Surakarta kota RT.03/RW.04",
        //     "kecamatan" => "Kota",
        //     "no_hp" => "081225755325",
        //     "kota" => "Surakarta",
        //     "provinsi" => "JAWA TENGAH",
        //     "email" => "arwabatik@gmail.com",
        //     "status" => 1
        // ]);
        // DB::table('penyedias')->insert([
        //     "nama" => "Pink n Blue Creative preneur",
        //     "alamat" => "Purbalingga kota RT.03/RW.04",
        //     "kecamatan" => "Kota",
        //     "no_hp" => "081225755325",
        //     "kota" => "Purbalingga",
        //     "provinsi" => "JAWA TENGAH",
        //     "email" => "pnbcreative@gmail.com",
        //     "status" => 1
        // ]);
        // DB::table('penyedias')->insert([
        //     "nama" => "FLAMINGGO INDONESIA",
        //     "alamat" => "Semarang kota RT.03/RW.04",
        //     "kecamatan" => "Kota",
        //     "no_hp" => "081225755325",
        //     "kota" => "Semarang",
        //     "provinsi" => "JAWA TENGAH",
        //     "email" => "flaminggo@gmail.com",
        //     "status" => 1
        // ]);
        // DB::table('penyedias')->insert([
        //     "nama" => "Success Management Event Organizer",
        //     "alamat" => "Semarang kota RT.03/RW.04",
        //     "kecamatan" => "Kota",
        //     "no_hp" => "081225755325",
        //     "kota" => "Semarang",
        //     "provinsi" => "JAWA TENGAH",
        //     "email" => "successmanagement@gmail.com",
        //     "status" => 1
        // ]);
        // DB::table('penyedias')->insert([
        //     "nama" => "SETYA SANGKAR BURUNG",
        //     "alamat" => "Semarang kota RT.03/RW.04",
        //     "kecamatan" => "Kota",
        //     "no_hp" => "081225755325",
        //     "kota" => "Semarang",
        //     "provinsi" => "JAWA TENGAH",
        //     "email" => "setyasangkar@gmail.com",
        //     "status" => 1
        // ]);
        // DB::table('penyedias')->insert([
        //     "nama" => "Soto Sekengkel pak Jon’s",
        //     "alamat" => "Banyumas kota RT.03/RW.04",
        //     "kecamatan" => "Kota",
        //     "no_hp" => "081225755325",
        //     "kota" => "Banyumas",
        //     "provinsi" => "JAWA TENGAH",
        //     "email" => "sotosengkekel@gmail.com",
        //     "status" => 1
        // ]);
    }
}
