<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghapusan extends Model
{
    use HasFactory;
    protected $table = 'penghapusan';
    protected $fillable = ['barang_id', 'jumlah_dihapus', 'alasan', 'tanggal'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
