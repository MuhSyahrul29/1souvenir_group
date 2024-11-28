<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKardusTable extends Migration
{
    public function up()
    {
        Schema::create('tb_kardus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kardus');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_kardus');
    }
}
