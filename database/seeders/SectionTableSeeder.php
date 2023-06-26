<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sections')->insert([
            "nama" => "MUA",
            "status" => 1
        ]);
        DB::table('sections')->insert([
            "nama" => "Khitan",
            "status" => 1
        ]);
        DB::table('sections')->insert([
            "nama" => "Wedding",
            "status" => 1
        ]);
    }
}
