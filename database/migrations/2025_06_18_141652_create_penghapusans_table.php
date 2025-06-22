<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    if (!Schema::hasTable('penghapusan')) {
        Schema::create('penghapusan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('barang')->cascadeOnDelete();
            $table->integer('jumlah_dihapus');
            $table->text('alasan');
            $table->date('tanggal');
            $table->timestamps();
        });
    }
}



    public function down(): void
    {
        Schema::dropIfExists('penghapusan');
    }
};