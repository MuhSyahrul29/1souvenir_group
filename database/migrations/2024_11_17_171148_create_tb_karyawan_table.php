<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKaryawanTable extends Migration
{
    public function up()
    {
        Schema::create('tb_karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('inisial')->length(9);
            $table->unsignedBigInteger('user_id')->nullable(); // Relasi ke tabel users
            $table->timestamps();

            // Foreign key ke tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_karyawan');
    }
}
