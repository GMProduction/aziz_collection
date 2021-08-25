<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeranjangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_produk')->unsigned()->nullable(true);
            $table->foreign('id_produk')->references('id')->on('produks');
            $table->integer('qty');
            $table->bigInteger('total_harga');
            $table->bigInteger('id_pesanan')->unsigned()->nullable(true);
            $table->foreign('id_pesanan')->references('id')->on('pesanans');
            $table->text('keterangan')->nullable(true)->default(null);
            $table->bigInteger('id_user')->unsigned()->nullable(true);
            $table->foreign('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('keranjangs');
    }
}
