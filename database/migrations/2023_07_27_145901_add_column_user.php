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
        Schema::table('users', function (Blueprint $table) {
            $table->string('alamat')->after('name');
            $table->string('kecamatan')->after('alamat');
            $table->string('kota')->after('kecamatan');
            $table->string('provinsi')->after('kota');
            $table->string('kode_pos')->after('provinsi');
            $table->string('no_hp')->after('kode_pos');
            $table->tinyInteger('status')->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('alamat');
            $table->dropColumn('kecamatan');
            $table->dropColumn('kota');
            $table->dropColumn('provinsi');
            $table->dropColumn('kode_pos');
            $table->dropColumn('status');
        });
    }
};
