<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExoedisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedisis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pesanan')->unsigned()->nullable(true);
            $table->foreign('id_pesanan')->references('id')->on('pesanans');
            $table->string('nama');
            $table->string('service');
            $table->string('estimasi');
            $table->integer('id_kota');
            $table->string('nama_kota');
            $table->integer('id_propinsi');
            $table->string('nama_propinsi');
            $table->integer('biaya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exoedisis');
    }
}
