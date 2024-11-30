<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Pelanggan;
use App\Models\Penawaran;
use App\Models\Ekspedisi;
use App\Models\Stiker;
use App\Models\Compro;
use App\Models\Kardus;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    public function dashboard()
    {
        return view('karyawan.dashboard.index');
    }

    public function index()
    {
        $penawaran = Penawaran::with(['pelanggan', 'karyawan', 'ekspedisi', 'stiker', 'compro', 'kardus', 'brand'])->get();
        return view('karyawan.penawaran.index', compact('penawaran'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all(); // Ambil semua data pelanggan
        $karyawan = Karyawan::all(); // Ambil semua data karyawan
        $ekspedisi = Ekspedisi::all();
        $stiker = Stiker::all();
        $compro = Compro::all();
        $kardus = Kardus::all();
        $brand = Brand::all();

        return view('karyawan.penawaran.create', compact('pelanggan', 'karyawan', 'ekspedisi', 'stiker', 'compro', 'kardus', 'brand'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'tipe_order' => 'required|in:baru,modif,repeat',
            'referensi_so' => 'required|integer',
            'id_customer' => 'required|exists:tb_pelanggan,id',
            'id_karyawan' => 'required|exists:tb_karyawan,id',
            'nama_produk' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'biaya_kirim' => 'required|in:termasuk,tidak termasuk',
            'id_ekspedisi' => 'required|exists:tb_ekspedisi,id',
            'tgl_kirim' => 'required|date',
            'id_stiker' => 'required|exists:tb_stiker,id',
            'id_compro' => 'required|exists:tb_compro,id',
            'id_kardus' => 'required|exists:tb_kardus,id',
            'publikasi' => 'required|in:ya,tidak',
            'spesifikasi' => 'required|string',
            'keterangan' => 'nullable|string',
            'folder_kerja' => 'nullable|string',
            'id_brand' => 'required|exists:tb_brand,id',
        ]);

        // Format tanggal kirim
        $tgl_kirim = \Carbon\Carbon::parse($request->tgl_kirim)->format('Y-m-d H:i:s');

        // Simpan data penawaran
        Penawaran::create([
            'tipe_order' => $request->tipe_order,
            'referensi_so' => $request->referensi_so,
            'id_customer' => $request->id_customer,
            'id_karyawan' => $request->id_karyawan,
            'tanggal' => now(), // Tanggal saat ini
            'nama_produk' => $request->nama_produk,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'biaya_kirim' => $request->biaya_kirim,
            'id_ekspedisi' => $request->id_ekspedisi,
            'tgl_kirim' => $tgl_kirim,
            'id_stiker' => $request->id_stiker,
            'id_compro' => $request->id_compro,
            'id_kardus' => $request->id_kardus,
            'publikasi' => $request->publikasi,
            'spesifikasi' => $request->spesifikasi,
            'keterangan' => $request->keterangan,
            'folder_kerja' => $request->folder_kerja,
            'id_brand' => $request->id_brand,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('karyawan.penawaran.index')->with('success', 'Penawaran berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penawaran = Penawaran::findOrFail($id);
        $karyawan = Karyawan::all();
        $pelanggan = Pelanggan::all();
        $ekspedisi = Ekspedisi::all();
        $stiker = Stiker::all();
        $compro = Compro::all();
        $kardus = Kardus::all();
        $brand = Brand::all(); // Jika ada data brand

        return view('karyawan.penawaran.edit', compact('penawaran', 'pelanggan', 'karyawan', 'ekspedisi', 'stiker', 'compro', 'kardus', 'brand'));
    }

    public function update(Request $request, $id)
    {

        // Validasi data
        $request->validate([
            'tipe_order' => 'required|in:baru,modif,repeat',
            'referensi_so' => 'required|integer',
            'id_customer' => 'required|exists:tb_pelanggan,id',
            'id_karyawan' => 'required|exists:tb_karyawan,id',
            'nama_produk' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'biaya_kirim' => 'required|in:termasuk,tidak termasuk',
            'id_ekspedisi' => 'required|exists:tb_ekspedisi,id',
            'tgl_kirim' => 'required|date',
            'id_stiker' => 'required|exists:tb_stiker,id',
            'id_compro' => 'required|exists:tb_compro,id',
            'id_kardus' => 'required|exists:tb_kardus,id',
            'publikasi' => 'required|in:ya,tidak',
            'spesifikasi' => 'required|string',
            'keterangan' => 'nullable|string',
            'folder_kerja' => 'nullable|string',
            'id_brand' => 'required|exists:tb_brand,id',
        ]);

        // Temukan data berdasarkan ID
        $penawaran = Penawaran::findOrFail($id);

        // Format tanggal kirim
        $tgl_kirim = \Carbon\Carbon::parse($request->tgl_kirim)->format('Y-m-d H:i:s');

        // Update data
        $penawaran->update([
            'tipe_order' => $request->tipe_order,
            'referensi_so' => $request->referensi_so,
            'id_customer' => $request->id_customer,
            'id_karyawan' => $request->id_karyawan,
            'nama_produk' => $request->nama_produk,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'biaya_kirim' => $request->biaya_kirim,
            'id_ekspedisi' => $request->id_ekspedisi,
            'tgl_kirim' => $tgl_kirim,
            'id_stiker' => $request->id_stiker,
            'id_compro' => $request->id_compro,
            'id_kardus' => $request->id_kardus,
            'publikasi' => $request->publikasi,
            'spesifikasi' => $request->spesifikasi,
            'keterangan' => $request->keterangan,
            'folder_kerja' => $request->folder_kerja,
            'id_brand' => $request->id_brand,
        ]);

        // Redirect ke halaman daftar penawaran dengan pesan sukses
        return redirect()->route('karyawan.penawaran.index')->with('success', 'Penawaran berhasil diperbarui.');
    }

    public function delete($id)
    {
        Penawaran::findOrFail($id)->delete();
        return redirect()->route('karyawan.penawaran.index')->with('success', 'Penawaran berhasil dihapus.');
    }
}
