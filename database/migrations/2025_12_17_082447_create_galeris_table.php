<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint; // Ini harus ada
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Pastikan di bawah ini tulisannya Blueprint, bukan Table
        Schema::create('galeris', function (Blueprint $table) {
            $table->id();
            $table->string('judul');      
            $table->string('file_media'); 
            $table->string('kategori');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeris');
    }
};