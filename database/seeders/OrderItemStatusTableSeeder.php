<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderItemStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_item_statuses')->insert([
            "nama" => "Pending",
            "status" => 1
        ]);
        DB::table('order_item_statuses')->insert([
            "nama" => "onproses",
            "status" => 1
        ]);
        DB::table('order_item_statuses')->insert([
            "nama" => "success",
            "status" => 1
        ]);
    }
}
