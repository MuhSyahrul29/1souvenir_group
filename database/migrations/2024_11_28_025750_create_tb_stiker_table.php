<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbStikerTable extends Migration
{
    public function up()
    {
        Schema::create('tb_stiker', function (Blueprint $table) {
            $table->id();
            $table->string('nama_stiker');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_stiker');
    }
}
