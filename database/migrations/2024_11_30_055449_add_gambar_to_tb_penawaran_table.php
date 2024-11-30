<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tb_penawaran', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('id_brand');
        });
    }

    public function down()
    {
        Schema::table('tb_penawaran', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
    }
};
