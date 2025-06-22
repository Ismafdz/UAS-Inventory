<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('barang', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('kode_barang')->unique();
        $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade');
        $table->foreignId('lokasi_id')->constrained('lokasi')->onDelete('cascade');
        $table->integer('jumlah');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};