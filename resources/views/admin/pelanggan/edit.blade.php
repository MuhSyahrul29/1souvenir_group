@extends('admin.layout.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <h1>Edit Data Pelanggan</h1>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Form Edit Pelanggan</h3>
                            </div>
                            <form action="{{ route('admin.pelanggan.update', $pelanggan->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name_customer">Nama Pelanggan</label>
                                        <input type="text" class="form-control" id="name_customer" name="name_customer"
                                            value="{{ $pelanggan->name_customer }}" placeholder="Masukkan Nama Pelanggan" required>
                                        @error('name_customer')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
