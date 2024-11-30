<?php

namespace App\Http\Controllers;

use App\Models\Penawaran;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganConrtroller extends Controller
{
    public function dashboard()
    {
        return view('pelanggan.dashboard.index');
    }

    public function indexPenawaran()
{
    // Ambil pengguna yang sedang login
    $user = Auth::user();

    // Cari pelanggan terkait dengan user_id dari pengguna login
    $pelanggan = Pelanggan::where('user_id', $user->id)->first();

    if (!$pelanggan) {
        return redirect()->route('pelanggan.dashboard')->with('error', 'Data pelanggan tidak ditemukan.');
    }

    // Ambil data penawaran berdasarkan pelanggan
    $penawaran = Penawaran::with(['karyawan', 'ekspedisi', 'stiker', 'compro', 'kardus', 'brand'])
        ->where('id_customer', $pelanggan->id)
        ->get();

    // Debugging untuk memastikan data diambil
    // dd($penawaran);

    return view('pelanggan.penawaran.index', compact('penawaran'));
}
}
