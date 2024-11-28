<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penawaran;

class PenawaranTableSeeder extends Seeder
{
    public function run()
    {
        // Buat data dummy
        Penawaran::create([
            'tipe_order' => 'baru',
            'referensi_so' => '12345',
            'id_customer' => 1,
            'id_karyawan' => 1,
            'tanggal' => now(),
            'nama_produk' => 'Produk A',
            'jumlah' => 100,
            'harga' => 50000,
            'biaya_kirim' => 'termasuk',
            'id_ekspedisi' => 1,
            'tgl_kirim' => now()->addDays(7),
            'id_stiker' => 1,
            'id_compro' => 1,
            'id_kardus' => 1,
            'publikasi' => 'ya',
            'spesifikasi' => 'Spesifikasi produk A',
            'keterangan' => 'Keterangan tambahan',
            'folder_kerja' => 'folder_A',
            'id_brand' => 1,
        ]);
    }
}
