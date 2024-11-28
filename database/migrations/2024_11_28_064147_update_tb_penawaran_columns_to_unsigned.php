<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTbPenawaranColumnsToUnsigned extends Migration
{
    public function up()
    {
        Schema::table('tb_penawaran', function (Blueprint $table) {
            // Ubah kolom menjadi unsigned
            $table->unsignedBigInteger('id_ekspedisi')->change();
            $table->unsignedBigInteger('id_stiker')->change();
            $table->unsignedBigInteger('id_compro')->change();
            $table->unsignedBigInteger('id_kardus')->change();
        });
    }

    public function down()
    {
        Schema::table('tb_penawaran', function (Blueprint $table) {
            // Kembalikan kolom ke tipe semula (integer)
            $table->integer('id_ekspedisi')->change();
            $table->integer('id_stiker')->change();
            $table->integer('id_compro')->change();
            $table->integer('id_kardus')->change();
        });
    }
}
