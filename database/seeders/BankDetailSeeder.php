<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class BankDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bank_details')->insert([
            "penyedia_id" => 1,
            "jenis_bank" => "BCA",
            "nomor_bank" => "2470545197",
            "nama_pemilik_bank" => "AKHOLIFATUL ARDLI",
        ]);
    }
}
