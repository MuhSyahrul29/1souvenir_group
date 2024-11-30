@extends('karyawan.layout.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Penawaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('karyawan.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Penawaran</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-12">
                    <a href="{{ route('karyawan.penawaran.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Penawaran
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel Penawaran</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tipe Order</th>
                                <th>Referensi SO</th>
                                <th>Customer</th>
                                <th>Karyawan</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Biaya Kirim</th>
                                <th>Ekspedisi</th>
                                <th>Tanggal Kirim</th>
                                <th>Stiker</th>
                                <th>Compro</th>
                                <th>Kardus</th>
                                <th>Publikasi</th>
                                <th>Spesifikasi</th>
                                <th>Keterangan</th>
                                <th>Folder Kerja</th>
                                <th>Brand</th>
                                <th>Tanggal</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penawaran as $key => $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->tipe_order }}</td>
                                    <td>{{ $p->referensi_so }}</td>
                                    <td>{{ $p->pelanggan->name_customer ?? '-' }}</td>
                                    <td>{{ $p->karyawan->name ?? '-' }}</td>
                                    <td>{{ $p->nama_produk }}</td>
                                    <td>{{ $p->jumlah }}</td>
                                    <td>Rp{{ number_format($p->harga, 0, ',', '.') }}</td>
                                    <td>{{ $p->biaya_kirim }}</td>
                                    <td>{{ $p->ekspedisi->nama_ekspedisi ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($p->tgl_kirim)->format('d-m-Y') }}</td>
                                    <td>{{ $p->stiker->nama_stiker ?? '-' }}</td>
                                    <td>{{ $p->compro->nama_compro ?? '-' }}</td>
                                    <td>{{ $p->kardus->nama_kardus ?? '-' }}</td>
                                    <td>{{ $p->publikasi }}</td>
                                    <td>{{ $p->spesifikasi }}</td>
                                    <td>{{ $p->keterangan }}</td>
                                    <td>{{ $p->folder_kerja }}</td>
                                    <td>{{ $p->brand->nama_brand ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d-m-Y') }}</td>
                                    <td>
                                        @if ($p->gambar)
                                            <a href="#" data-toggle="modal" data-target="#gambarModal{{ $p->id }}">
                                                <img src="{{ asset('storage/' . $p->gambar) }}" alt="Gambar Produk" width="50">
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="gambarModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel{{ $p->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="gambarModalLabel{{ $p->id }}">Gambar Produk</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <img src="{{ asset('storage/' . $p->gambar) }}" alt="Gambar Produk" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            Tidak ada gambar
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <div class="dropdown-menu">
                                                <!-- Edit Option -->
                                                <a class="dropdown-item" href="{{ route('karyawan.penawaran.edit', $p->id) }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <!-- Hapus Option -->
                                                <button class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-hapus-{{ $p->id }}">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Modal Hapus -->
                                        <div class="modal fade" id="modal-hapus-{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    < div class="modal-header">
                                                        <h5 class="modal-title" id="modalHapusLabel">Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus penawaran <b>{{ $p->nama_produk }}</b>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <form action="{{ route('karyawan.penawaran.delete', $p->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Hapus -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
