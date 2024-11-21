<?php

namespace App\Http\Controllers;

use App\Models\Penawaran;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Pelanggan;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Ambil semua data penawaran dengan relasi pelanggan dan karyawan
        $penawaran = Penawaran::with(['pelanggan', 'karyawan'])->get();

        return view('admin.dashboard.index', compact('penawaran'));
    }

    public function indexKaryawan()
    {
        $karyawan = Karyawan::all(); // Ambil semua data karyawan
        return view('admin.karyawan.index', compact('karyawan'));
    }

    public function createKaryawan()
    {
        return view('admin.karyawan.create');
    }
    public function storeKaryawan(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'inisial' => 'required|string|max:10',
        ]);

        Karyawan::create($request->only('name', 'inisial'));
        return redirect()->route('admin.karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function editKaryawan($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('admin.karyawan.edit', compact('karyawan'));
    }

    public function updateKaryawan(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'inisial' => 'required|string|max:10',
        ]);

        Karyawan::where('id', $id)->update($request->only('name', 'inisial'));
        return redirect()->route('admin.karyawan.index')->with('success', 'Karyawan berhasil diperbarui.');
    }

    public function deleteKaryawan($id)
    {
        Karyawan::findOrFail($id)->delete();
        return redirect()->route('admin.karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
    }

    public function indexPelanggan()
    {
        $pelanggan = Pelanggan::all(); // Ambil semua data pelanggan
        return view('admin.pelanggan.index', compact('pelanggan'));
    }

    public function createPelanggan()
    {
        return view('admin.pelanggan.create');
    }

    public function storePelanggan(Request $request)
    {
        $request->validate([
            'name_customer' => 'required|string|max:255',
        ]);

        Pelanggan::create($request->only('name_customer'));
        return redirect()->route('admin.pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function editPelanggan($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', compact('pelanggan'));
    }

    public function updatePelanggan(Request $request, $id)
    {
        $request->validate([
            'name_customer' => 'required|string|max:255',
        ]);

        Pelanggan::where('id', $id)->update($request->only('name_customer'));
        return redirect()->route('admin.pelanggan.index')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    public function deletePelanggan($id)
    {
        Pelanggan::findOrFail($id)->delete();
        return redirect()->route('admin.pelanggan.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
