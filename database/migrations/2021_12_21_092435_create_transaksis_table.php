<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            // $table->id();
            
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_outlet');
            $table->unsignedBigInteger('id_member');
            $table->unsignedBigInteger('id_paket');
            $table->unsignedBigInteger('id_petugas');
            $table->double('qty');
            $table->date('tgl');
            $table->date('batas_waktu');
            $table->date('tgl_bayar')->nullable();
            $table->enum('status', ['proses', 'selesai', 'diambil']);
            $table->enum('dibayar', ['dibayar', 'belum_dibayar']);
            $table->foreign('id_outlet')->references('id')->on('outlet');
            $table->foreign('id_member')->references('id')->on('member');
            $table->foreign('id_paket')->references('id')->on('paket');
            $table->foreign('id_petugas')->references('id')->on('user');
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
        Schema::dropIfExists('transaksis');
    }
}
