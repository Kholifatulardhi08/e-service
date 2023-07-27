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
            $table->string('alamat')->nullable()->after('name');
            $table->string('kecamatan')->nullable()->after('alamat');
            $table->string('kota')->nullable()->after('kecamatan');
            $table->string('provinsi')->nullable()->after('kota');
            $table->string('kode_pos')->nullable()->after('provinsi');
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
