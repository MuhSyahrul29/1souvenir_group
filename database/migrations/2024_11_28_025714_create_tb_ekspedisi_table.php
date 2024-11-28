<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbEkspedisiTable extends Migration
{
    public function up()
    {
        Schema::create('tb_ekspedisi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ekspedisi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_ekspedisi');
    }
}
