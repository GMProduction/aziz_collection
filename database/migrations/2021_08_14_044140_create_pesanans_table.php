<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal_pesanan');
            $table->text('alamat_pengiriman');
            $table->integer('biaya_pengiriman');
            $table->tinyInteger('status_pesanan')->default(0);
            $table->bigInteger('id_user')->unsigned()->nullable(true);
            $table->foreign('id_user')->references('id')->on('users');
            $table->bigInteger('total_harga');
            $table->bigInteger('id_bank')->unsigned()->nullable(true);
            $table->foreign('id_bank')->references('id')->on('banks');
            $table->dateTime('tanggal_pembayaran')->nullable(true)->default(null);
            $table->text('url_pembayaran')->nullable(true)->default(true);
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
        Schema::dropIfExists('pesanans');
    }
}
