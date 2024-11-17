<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbBrandTable extends Migration
{
    public function up()
    {
        Schema::create('tb_brand', function (Blueprint $table) {
            $table->id();
            $table->string('nama_brand');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_brand');
    }
}