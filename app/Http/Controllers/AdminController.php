<?php

namespace App\Http\Controllers;

use App\Models\Penawaran;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Pelanggan;
use App\Models\Ekspedisi;
use App\Models\Stiker;
use App\Models\Compro;
use App\Models\Kardus;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

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
        $karyawan = \App\Models\Karyawan::with('user')->get(); // Ambil semua data karyawan
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

    // public function indexPenawaran()
    // {
    //     $penawaran = Penawaran::with(['pelanggan', 'karyawan', 'ekspedisi', 'stiker', 'compro', 'kardus', 'brand'])->get();
    //     return view('admin.penawaran.index', compact('penawaran'));
    // }

    public function indexPenawaran(Request $request)
    {
        // Ambil nilai pencarian dari input (jika ada)
        $query = $request->input('table_search');

        // Ambil data penawaran dengan pencarian nama produk (jika ada)
        $penawaran = Penawaran::with(['pelanggan', 'karyawan', 'ekspedisi', 'stiker', 'compro', 'kardus', 'brand'])
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('nama_produk', 'like', '%' . $query . '%');
            })
            ->paginate(0); // Menggunakan paginasi (opsional)

        // Kirim data ke view
        return view('admin.penawaran.index', compact('penawaran', 'query'));
    }


    public function createPenawaran()
    {
        $pelanggan = Pelanggan::all(); // Ambil semua data pelanggan
        $karyawan = Karyawan::all(); // Ambil semua data karyawan
        $ekspedisi = Ekspedisi::all();
        $stiker = Stiker::all();
        $compro = Compro::all();
        $kardus = Kardus::all();
        $brand = Brand::all();

        return view('admin.penawaran.create', compact('pelanggan', 'karyawan', 'ekspedisi', 'stiker', 'compro', 'kardus', 'brand'));
    }


    public function storePenawaran(Request $request)
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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Format tanggal kirim
        $tgl_kirim = \Carbon\Carbon::parse($request->tgl_kirim)->format('Y-m-d H:i:s');

        // Handle file upload
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            // Ambil nama asli file
            $fileName = time() . '-' . $file->getClientOriginalName();
            // Simpan file di folder 'penawaran' dengan nama asli
            $gambarPath = $file->storeAs('penawaran', $fileName, 'public');
        }

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
            'gambar' => $gambarPath,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.penawaran.index')->with('success', 'Penawaran berhasil ditambahkan!');
    }


    public function editPenawaran($id)
    {
        $penawaran = Penawaran::findOrFail($id);
        $karyawan = Karyawan::all();
        $pelanggan = Pelanggan::all();
        $ekspedisi = Ekspedisi::all();
        $stiker = Stiker::all();
        $compro = Compro::all();
        $kardus = Kardus::all();
        $brand = Brand::all(); // Jika ada data brand

        return view('admin.penawaran.edit', compact('penawaran', 'pelanggan', 'karyawan', 'ekspedisi', 'stiker', 'compro', 'kardus', 'brand'));
    }

    public function updatePenawaran(Request $request, $id)
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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Temukan data berdasarkan ID
        $penawaran = Penawaran::findOrFail($id);

        // Format tanggal kirim
        $tgl_kirim = \Carbon\Carbon::parse($request->tgl_kirim)->format('Y-m-d H:i:s');

        // Handle file upload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($penawaran->gambar && Storage::disk('public')->exists($penawaran->gambar)) {
                Storage::disk('public')->delete($penawaran->gambar);
            }
            // Ambil file yang diunggah
            $file = $request->file('gambar');
            // Buat nama file baru dengan format angka-namaasli.ext
            $fileName = time() . '-' . $file->getClientOriginalName();
            // Simpan file di folder 'penawaran' dengan nama baru
            $gambarPath = $file->storeAs('penawaran', $fileName, 'public');
        } else {
            $gambarPath = $penawaran->gambar; // Tetap gunakan gambar lama jika tidak ada perubahan
        }

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
            'gambar' => $gambarPath,
        ]);

        // Redirect ke halaman daftar penawaran dengan pesan sukses
        return redirect()->route('admin.penawaran.index')->with('success', 'Penawaran berhasil diperbarui.');
    }

    public function deletePenawaran($id)
    {
        Penawaran::findOrFail($id)->delete();
        return redirect()->route('admin.penawaran.index')->with('success', 'Penawaran berhasil dihapus.');
    }
}
