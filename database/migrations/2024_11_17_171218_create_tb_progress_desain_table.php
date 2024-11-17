<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbProgressDesainTable extends Migration
{
    public function up()
    {
        Schema::create('tb_progress_desain', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penawaran')->constrained('tb_penawaran')->onDelete('cascade');
            $table->integer('no_progress');
            $table->dateTime('tgl_order');
            $table->dateTime('tgl_dikerjakan');
            $table->dateTime('tgl_selesai');
            $table->integer('id_desainer');
            $table->text('deskripsi_progress');
            $table->enum('request_progress', ['pelanggan', 'cro', 'desainer']);
            $table->integer('tingkat_kesulitan');
            $table->integer('kaidah_desain');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_progress_desain');
    }
}