<?php

namespace App\Http\Controllers;
use App\Models\Karyawan;
use App\Models\Penawaran;
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
        $penawaran = Penawaran::all();

        return view('karyawan.penawaran.index', compact('penawaran'));
    }

    public function create()
    {
        return view('karyawan.penawaran.create');
    }

    public function store(Request $request)
{
    dd($request->all());
    // Validasi data
    $request->validate([
        'tipe_order' => 'required|in:baru,modif,repeat',
        'referensi_so' => 'required|integer',
        'nama_produk' => 'required|string|max:255',
        'jumlah' => 'required|integer|min:1',
        'harga' => 'required|numeric|min:0',
        'biaya_kirim' => 'required|in:termasuk,tidak termasuk',
        'tgl_kirim' => 'required|date',
        'publikasi' => 'required|in:ya,tidak',
        'spesifikasi' => 'required|string',
        'keterangan' => 'nullable|string',
    ]);

    // Simpan data ke database
    Penawaran::create([
        'tipe_order' => $request->tipe_order,
        'referensi_so' => $request->referensi_so,
        'id_customer' => 1, // Sesuaikan kebutuhan
        'id_karyawan' => auth()->id(),
        'tanggal' => now()->toDateTimeString(), // Format datetime
        'nama_produk' => $request->nama_produk,
        'jumlah' => $request->jumlah,
        'harga' => $request->harga,
        'biaya_kirim' => $request->biaya_kirim,
        'tgl_kirim' => date('Y-m-d H:i:s', strtotime($request->tgl_kirim)), // Konversi ke format datetime
        'publikasi' => $request->publikasi,
        'spesifikasi' => $request->spesifikasi,
        'keterangan' => $request->keterangan ?? '',
    ]);

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('karyawan.penawaran.index')->with('success', 'Penawaran berhasil ditambahkan.');
}

}
