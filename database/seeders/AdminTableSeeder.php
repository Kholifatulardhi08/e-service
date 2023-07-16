<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            "nama" => "Admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make("1234567890"),
            "no_hp" => "081225755325",
            "type" => "superadmin",
            "image" => "",
            "status" => 1,
            "penyedia_id" => 0,
        ]);
        DB::table('admins')->insert([
            "nama" => "Kholifard",
            "email" => "kholifard@gmail.com",
            "password" => Hash::make("1234567890"),
            "no_hp" => "081225755325",
            "type" => "penyedia",
            "image" => "",
            "status" => 0,
            "penyedia_id" => 1,
        ]);
        // DB::table('admins')->insert([
        //     "nama" => "Kreasinovaphotostudio",
        //     "email" => "Kreasinovaphotostudio@gmail.com",
        //     "password" => Hash::make("1234567890"),
        //     "no_hp" => "081225755325",
        //     "type" => "penyedia",
        //     "image" => "",
        //     "status" => 0,
        //     "penyedia_id" => 2,
        // ]);
        // DB::table('admins')->insert([
        //     "nama" => "Cv. Surya Perdana",
        //     "email" => "suryaperdana@gmail.com",
        //     "password" => Hash::make("1234567890"),
        //     "no_hp" => "081225755325",
        //     "type" => "penyedia",
        //     "image" => "",
        //     "status" => 0,
        //     "penyedia_id" => 3,
        // ]);
        // DB::table('admins')->insert([
        //     "nama" => "Arwa Batik",
        //     "email" => "arwabatik@gmail.com",
        //     "password" => Hash::make("1234567890"),
        //     "no_hp" => "081225755325",
        //     "type" => "penyedia",
        //     "image" => "",
        //     "status" => 0,
        //     "penyedia_id" => 4,
        // ]);
    }
}
