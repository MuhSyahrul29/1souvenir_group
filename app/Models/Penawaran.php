<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penawaran extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'tb_penawaran';

    // Tentukan kolom yang dapat diisi (fillable)
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

    public function setTglKirimAttribute($value)
    {
        $this->attributes['tgl_kirim'] = date('Y-m-d H:i:s', strtotime($value));
    }
}
