<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasi_meja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('detail_id')->constrained(); 
            $table->string('nama');
            $table->integer('no_telp');
            $table->integer('jumlah_orang');
            $table->dateTime('tanggal_jam');
            $table->integer('waktu_kedatangan')->default(30);
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
        Schema::dropIfExists('reservasi_meja');
    }
}
