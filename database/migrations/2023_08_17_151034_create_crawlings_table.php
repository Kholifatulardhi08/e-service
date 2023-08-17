<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('crawlings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk')->nullable();
            $table->string('website')->nullable();
            $table->string('rating')->nullable();
            $table->string('harga')->nullable();
            $table->string('url')->nullable();
            $table->string('gambar_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crawlings');
    }
};