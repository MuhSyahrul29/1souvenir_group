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

    protected $dates = ['tgl_kirim'];

    // Relasi ke Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id');
    }

    // Relasi ke Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_customer', 'id');
    }

    public function ekspedisi()
    {
        return $this->belongsTo(Ekspedisi::class, 'id_ekspedisi', 'id');
    }

    public function stiker()
    {
        return $this->belongsTo(Stiker::class, 'id_stiker', 'id');
    }

    public function compro()
    {
        return $this->belongsTo(Compro::class, 'id_compro', 'id');
    }

    public function kardus()
    {
        return $this->belongsTo(Kardus::class, 'id_kardus', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'id_brand', 'id');
    }

    // Relasi ke User melalui Karyawan
    public function userKaryawan()
    {
        return $this->hasOneThrough(User::class, Karyawan::class, 'id', 'id', 'id_karyawan', 'user_id');
    }

    // Relasi ke User melalui Pelanggan
    public function userPelanggan()
    {
        return $this->hasOneThrough(User::class, Pelanggan::class, 'id', 'id', 'id_customer', 'user_id');
    }
}

