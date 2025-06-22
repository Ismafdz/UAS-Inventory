<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatMutasi extends Model
{
    use HasFactory;
    protected $table = 'riwayat_mutasi';
    protected $fillable = ['barang_id', 'asal_lokasi_id', 'tujuan_lokasi_id', 'jumlah_mutasi', 'tanggal'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
     public function asalLokasi()
    {
        return $this->belongsTo(Lokasi::class, 'asal_lokasi_id');
    }

    public function tujuanLokasi()
    {
        return $this->belongsTo(Lokasi::class, 'tujuan_lokasi_id');
    }
}
