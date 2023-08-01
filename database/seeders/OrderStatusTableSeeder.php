<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_statuses')->insert([
            "nama" => "New",
            "status" => 1
        ]);
        DB::table('order_statuses')->insert([
            "nama" => "COD",
            "status" => 1
        ]);
        DB::table('order_statuses')->insert([
            "nama" => "Prepaid",
            "status" => 1
        ]);
        DB::table('order_statuses')->insert([
            "nama" => "Paid",
            "status" => 1
        ]);
        DB::table('order_statuses')->insert([
            "nama" => "Canceled",
            "status" => 1
        ]);
    }
}
