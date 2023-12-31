<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            AdminTableSeeder::class,
            // PenyediaTableSeeder::class,
            // BankDetailSeeder::class,
            // JasaDetailSeeder::class,
            // SectionTableSeeder::class,
            // CategoryTableSeeder::class,
            // BrandTableSeeder::class,
            // ProductTableSeeder::class,
            // ProducAtributeTableSeeder::class,
            // BannerTableSeeder::class,
            OrderStatusTableSeeder::class
        ]);
    }
}
