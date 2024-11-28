<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTbPenawaranTableAddForeignKeys extends Migration
{
    public function up()
    {
        Schema::table('tb_penawaran', function (Blueprint $table) {
            $table->foreign('id_ekspedisi')->references('id')->on('tb_ekspedisi')->onDelete('cascade');
            $table->foreign('id_stiker')->references('id')->on('tb_stiker')->onDelete('cascade');
            $table->foreign('id_compro')->references('id')->on('tb_compro')->onDelete('cascade');
            $table->foreign('id_kardus')->references('id')->on('tb_kardus')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('tb_penawaran', function (Blueprint $table) {
            $table->dropForeign(['id_ekspedisi']);
            $table->dropForeign(['id_stiker']);
            $table->dropForeign(['id_compro']);
            $table->dropForeign(['id_kardus']);
        });
    }
}
