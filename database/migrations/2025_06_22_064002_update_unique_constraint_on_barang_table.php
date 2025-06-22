<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            // Drop unique constraint kode_barang jika ada
            DB::statement('ALTER TABLE barang DROP INDEX barang_kode_barang_unique');

            // Tambahkan unique baru untuk kombinasi kode_barang dan lokasi_id
            $table->unique(['kode_barang', 'lokasi_id'], 'kode_barang_lokasi_unique');
        });
    }

    public function down(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            // Drop composite unique key
            $table->dropUnique('kode_barang_lokasi_unique');

            // Tambahkan kembali unique hanya untuk kode_barang
            $table->unique('kode_barang', 'barang_kode_barang_unique');
        });
    }
};
