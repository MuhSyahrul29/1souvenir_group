<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPelangganTable extends Migration
{
    public function up()
    {
        Schema::create('tb_pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('name_customer');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_pelanggan');
    }
}