<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('id');
            $table->string('nama', 100);
            $table->string('username', 30);
            $table->string('password');
            $table->unsignedBigInteger('id_outlet');
            $table->enum('role', ['admin', 'kasir', 'owner']);

            $table->foreign('id_outlet')->references('id')->on('outlet');
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
        Schema::dropIfExists('penggunas');
    }
}
