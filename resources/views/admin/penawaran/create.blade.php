@extends('admin.layout.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Penawaran</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Tambah Penawaran</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <form id="createPenawaranForm" action="{{ route('admin.penawaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Penawaran</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipe_order">Tipe Order</label>
                                        <select name="tipe_order" id="tipe_order" class="form-control" required>
                                            <option value="baru">Baru</option>
                                            <option value="modif">Modifikasi</option>
                                            <option value="repeat">Repeat</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="referensi_so">Referensi SO</label>
                                        <input type="number" name="referensi_so" id="referensi_so" class="form-control"
                                            placeholder="Masukkan Referensi SO" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_customer">Pelanggan</label>
                                        <select name="id_customer" id="id_customer" class="form-control" required>
                                            <option value="">Pilih Pelanggan</option>
                                            @foreach ($pelanggan as $p)
                                                <option value="{{ $p->id }}">{{ $p->name_customer }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_karyawan">Karyawan</label>
                                        <select name="id_karyawan" id="id_karyawan" class="form-control" required>
                                            <option value="">Pilih Karyawan</option>
                                            @foreach ($karyawan as $k)
                                                <option value="{{ $k->id }}">{{ $k->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_produk">Nama Produk</label>
                                        <input type="text" name="nama_produk" id="nama_produk" class="form-control"
                                            placeholder="Masukkan Nama Produk" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah</label>
                                        <input type="number" name="jumlah" id="jumlah" class="form-control"
                                            placeholder="Masukkan Jumlah" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input type="number" name="harga" id="harga" class="form-control"
                                            placeholder="Masukkan Harga" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="biaya_kirim">Biaya Kirim</label>
                                        <select name="biaya_kirim" id="biaya_kirim" class="form-control" required>
                                            <option value="termasuk">Termasuk</option>
                                            <option value="tidak termasuk">Tidak Termasuk</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_ekspedisi">Ekspedisi</label>
                                        <select name="id_ekspedisi" id="id_ekspedisi" class="form-control" required>
                                            <option value="">Pilih Ekspedisi</option>
                                            @foreach ($ekspedisi as $e)
                                                <option value="{{ $e->id }}">{{ $e->nama_ekspedisi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_kirim">Tanggal Kirim</label>
                                        <input type="datetime-local" name="tgl_kirim" id="tgl_kirim" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_stiker">Stiker</label>
                                        <select name="id_stiker" id="id_stiker" class="form-control" required>
                                            <option value="">Pilih Stiker</option>
                                            @foreach ($stiker as $s)
                                                <option value="{{ $s->id }}">{{ $s->nama_stiker }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_compro">Compro</label>
                                        <select name="id_compro" id="id_compro" class="form-control" required>
                                            <option value="">Pilih Compro</option>
                                            @foreach ($compro as $c)
                                                <option value="{{ $c->id }}">{{ $c->nama_compro }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_kardus">Kardus</label>
                                        <select name="id_kardus" id="id_kardus" class="form-control" required>
                                            <option value="">Pilih Kardus</option>
                                            @foreach ($kardus as $k)
                                                <option value="{{ $k->id }}">{{ $k->nama_kardus }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="publikasi">Publikasi</label>
                                        <select name="publikasi" id="publikasi" class="form-control" required>
                                            <option value="ya">Ya</option>
                                            <option value="tidak">Tidak</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="spesifikasi">Spesifikasi</label>
                                        <textarea name="spesifikasi" id="spesifikasi" class="form-control" rows="4"
                                            placeholder="Masukkan Spesifikasi" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" class="form-control" rows="4" placeholder="Masukkan Keterangan"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="folder_kerja">Folder Kerja</label>
                                        <input type="text" name="folder_kerja" id="folder_kerja" class="form-control"
                                            placeholder="Masukkan Folder Kerja">
                                    </div>
                                    <div class="form-group">
                                        <label for="id_brand">Brand</label>
                                        <select name="id_brand" id="id_brand" class="form-control" required>
                                            <option value="">Pilih Brand</option>
                                            @foreach ($brand as $b)
                                                <option value="{{ $b->id }}">{{ $b->nama_brand }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="gambar">Upload Gambar</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                                <label class="custom-file-label" for="gambar">Pilih file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary swalDefaultSuccess">Simpan</button>
                            <a href="{{ route('admin.penawaran.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#createPenawaranForm').on('submit', function(e) {
                e.preventDefault(); // Cegah form langsung dikirim

                Swal.fire({
                    icon: 'success',
                    title: 'Data berhasil disimpan!',
                    showConfirmButton: false,
                    timer: 1000
                }).then(() => {
                    // Setelah notifikasi selesai, kirimkan form
                    this.submit();
                });
            });
        });
    </script>
    <script>
        // Untuk menampilkan nama file yang dipilih di label
        document.querySelector('.custom-file-input').addEventListener('change', function (e) {
            var fileName = document.getElementById("gambar").files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
    </script>
@endsection
