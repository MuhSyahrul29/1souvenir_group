<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPenawaranTable extends Migration
{
    public function up()
    {
        Schema::create('tb_penawaran', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe_order', ['baru', 'modif', 'repeat']);
            $table->integer('referensi_so');
            $table->foreignId('id_customer')->constrained('tb_pelanggan')->onDelete('cascade');
            $table->foreignId('id_karyawan')->constrained('tb_karyawan')->onDelete('cascade');
            $table->dateTime('tanggal');
            $table->string('nama_produk');
            $table->integer('jumlah');
            $table->decimal('harga', 10, 0);
            $table->enum('biaya_kirim', ['termasuk', 'tidak termasuk']);
            $table->integer('id_ekspedisi');
            $table->dateTime('tgl_kirim');
            $table->integer('id_stiker');
            $table->integer('id_compro');
            $table->integer('id_kardus');
            $table->enum('publikasi', ['ya', 'tidak']);
            $table->text('spesifikasi');
            $table->text('keterangan');
            $table->text('folder_kerja');
            $table->foreignId('id_brand')->constrained('tb_brand')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_penawaran');
    }
}
