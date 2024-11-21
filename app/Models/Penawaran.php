<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penawaran extends Model
{
    use HasFactory;

    protected $table = 'tb_penawaran';

    protected $fillable = [
        'tipe_order',
        'referensi_so',
        'id_customer',
        'id_karyawan',
        'tanggal',
        'nama_produk',
        'jumlah',
        'harga',
        'biaya_kirim',
        'id_ekspedisi',
        'tgl_kirim',
        'id_stiker',
        'id_compro',
        'id_kardus',
        'publikasi',
        'spesifikasi',
        'keterangan',
        'folder_kerja',
        'id_brand',
    ];

    // Relasi ke karyawan (user)
    public function karyawan()
    {
        return $this->belongsTo(User::class, 'id_karyawan');
    }

    // Relasi ke customer
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_customer');
    }
}

