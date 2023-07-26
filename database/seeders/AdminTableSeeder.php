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
    }
}
