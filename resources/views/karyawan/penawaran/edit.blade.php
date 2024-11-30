@extends('karyawan.layout.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Penawaran</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('karyawan.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('karyawan.penawaran.index') }}">Penawaran</a></li>
                            <li class="breadcrumb-item active">Edit Penawaran</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Form Edit Penawaran</h3>
                            </div>
                            <form action="{{ route('karyawan.penawaran.update', $penawaran->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Left Column -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tipe_order">Tipe Order</label>
                                                <select name="tipe_order" id="tipe_order" class="form-control" required>
                                                    <option value="baru" {{ $penawaran->tipe_order == 'baru' ? 'selected' : '' }}>Baru</option>
                                                    <option value="modif" {{ $penawaran->tipe_order == 'modif' ? 'selected' : '' }}>Modifikasi</option>
                                                    <option value="repeat" {{ $penawaran->tipe_order == 'repeat' ? 'selected' : '' }}>Repeat</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="referensi_so">Referensi SO</label>
                                                <input type="number" name="referensi_so" id="referensi_so" class="form-control" value="{{ $penawaran->referensi_so }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_customer">Customer</label>
                                                <select name="id_customer" id="id_customer" class="form-control" required>
                                                    @foreach ($pelanggan as $customer)
                                                        <option value="{{ $customer->id }}" {{ $penawaran->id_customer == $customer->id ? 'selected' : '' }}>
                                                            {{ $customer->name_customer }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_karyawan">Karyawan</label>
                                                <select name="id_karyawan" id="id_karyawan" class="form-control" required>
                                                    @foreach ($karyawan as $employee)
                                                        <option value="{{ $employee->id }}" {{ $penawaran->id_karyawan == $employee->id ? 'selected' : '' }}>
                                                            {{ $employee->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_produk">Nama Produk</label>
                                                <input type="text" name="nama_produk" id="nama_produk" class="form-control" value="{{ $penawaran->nama_produk }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jumlah">Jumlah</label>
                                                <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ $penawaran->jumlah }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="harga">Harga</label>
                                                <input type="number" name="harga" id="harga" class="form-control" value="{{ $penawaran->harga }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="biaya_kirim">Biaya Kirim</label>
                                                <select name="biaya_kirim" id="biaya_kirim" class="form-control" required>
                                                    <option value="termasuk" {{ $penawaran->biaya_kirim == 'termasuk' ? 'selected' : '' }}>Termasuk</option>
                                                    <option value="tidak termasuk" {{ $penawaran->biaya_kirim == 'tidak termasuk' ? 'selected' : '' }}>Tidak Termasuk</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_kirim">Tanggal Kirim</label>
                                                <input type="datetime-local" name="tgl_kirim" id="tgl_kirim" class="form-control" value="{{ \Carbon\Carbon::parse($penawaran->tgl_kirim)->format('Y-m-d\TH:i') }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_ekspedisi">Ekspedisi</label>
                                                <select name="id_ekspedisi" id="id_ekspedisi" class="form-control" required>
                                                    @foreach ($ekspedisi as $e)
                                                        <option value="{{ $e->id }}" {{ $penawaran->id_ekspedisi == $e->id ? 'selected' : '' }}>
                                                            {{ $e->nama_ekspedisi }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Right Column -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="id_stiker">Stiker</label>
                                                <select name="id_stiker" id="id_stiker" class="form-control" required>
                                                    @foreach ($stiker as $s)
                                                        <option value="{{ $s->id }}" {{ $penawaran->id_stiker == $s->id ? 'selected' : '' }}>
                                                            {{ $s->nama_stiker }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_compro">Compro</label>
                                                <select name="id_compro" id="id_compro" class="form-control" required>
                                                    @foreach ($compro as $c)
                                                        <option value="{{ $c->id }}" {{ $penawaran->id_compro == $c->id ? 'selected' : '' }}>
                                                            {{ $c->nama_compro }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_kardus">Kardus</label>
                                                <select name="id_kardus" id="id_kardus" class="form-control" required>
                                                    @foreach ($kardus as $k)
                                                        <option value="{{ $k->id }}" {{ $penawaran->id_kardus == $k->id ? 'selected' : '' }}>
                                                            {{ $k->nama_kardus }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="publikasi">Publikasi</label>
                                                <select name="publikasi" id="publikasi" class="form-control" required>
                                                    <option value="ya" {{ $penawaran->publikasi == 'ya' ? 'selected' : '' }}>Ya</option>
                                                    <option value="tidak" {{ $penawaran->publikasi == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="spesifikasi">Spesifikasi</label>
                                                <textarea name="spesifikasi" id="spesifikasi" class="form-control" rows="3" required>{{ $penawaran->spesifikasi }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <textarea name="keterangan" id="keterangan" class="form-control" rows="3">{{ $penawaran->keterangan }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="folder_kerja">Folder Kerja</label>
                                                <input type="text" name="folder_kerja" id="folder_kerja" class="form-control" value="{{ $penawaran->folder_kerja }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="id_brand">Brand</label>
                                                <select name="id_brand" id="id_brand" class="form-control" required>
                                                    @foreach ($brand as $b)
                                                        <option value="{{ $b->id }}" {{ $penawaran->id_brand == $b->id ? 'selected' : '' }}>
                                                            {{ $b->nama_brand }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="gambar">Gambar Produk</label>
                                                @if ($penawaran->gambar)
                                                    <div class="mb-3">
                                                        <img src="{{ asset('storage/' . $penawaran->gambar) }}" alt="Gambar Produk" class="img-thumbnail" style="width: 100px; height: auto;">
                                                    </div>
                                                @endif
                                                <div class="custom-file">
                                                    <input type="file" name="gambar" class="custom-file-input" id="gambar">
                                                    <label class="custom-file-label" for="gambar">Pilih file</label>
                                                </div>
                                                <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('karyawan.penawaran.index') }}" class="btn btn-secondary">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        // Untuk menampilkan nama file yang dipilih di label
        document.querySelector('.custom-file-input').addEventListener('change', function (e) {
            var fileName = document.getElementById("gambar").files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
    </script>
@endsection
