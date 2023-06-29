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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('nama');
            $table->string('image');
            $table->float('diskon');
            $table->text('deskripsi');
            $table->string('url');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keyword');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
