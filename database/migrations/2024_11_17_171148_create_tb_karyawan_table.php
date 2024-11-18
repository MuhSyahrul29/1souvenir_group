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
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_karyawan');
    }
}
