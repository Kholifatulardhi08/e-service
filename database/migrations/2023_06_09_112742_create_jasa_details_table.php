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
        Schema::create('jasa_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penyedia_id');
            $table->string('nama_toko');
            $table->string('alamat_toko');
            $table->string('kecamatan_toko');
            $table->string('kota_toko');
            $table->string('provinsi_toko');
            $table->string('kode_pos_toko');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jasa_details');
    }
};
