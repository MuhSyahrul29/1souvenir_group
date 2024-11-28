@extends('karyawan.layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Penawaran</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Tambah Penawaran</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('karyawan.penawaran.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Left column -->
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Form Tambah Penawaran</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
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
                                        <input type="text" class="form-control" id="referensi_so" name="referensi_so" placeholder="Masukkan Referensi SO" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_produk">Nama Produk</label>
                                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Masukkan Nama Produk" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="jumlah">Jumlah</label>
                                        <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="biaya_kirim">Biaya Kirim</label>
                                        <select name="biaya_kirim" id="biaya_kirim" class="form-control" required>
                                            <option value="termasuk">Termasuk</option>
                                            <option value="tidak termasuk">Tidak Termasuk</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_kirim">Tanggal Kirim</label>
                                        <input type="datetime-local" class="form-control" id="tgl_kirim" name="tgl_kirim" required>
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
                                        <textarea name="spesifikasi" id="spesifikasi" class="form-control" rows="4" placeholder="Masukkan Spesifikasi" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" class="form-control" rows="4" placeholder="Masukkan Keterangan"></textarea>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('karyawan.penawaran.index') }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
