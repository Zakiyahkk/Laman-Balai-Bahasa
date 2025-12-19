<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('galeris', function (Table $table) {
        $table->id();
        $table->string('judul');      // Untuk menyimpan "Judul Media"
        $table->string('file_media'); // Untuk menyimpan path/nama file
        $table->string('kategori');   // Untuk menyimpan "Kategori"
        $table->string('tipe');       // Untuk menyimpan "Tipe Media" (Foto/Video)
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
