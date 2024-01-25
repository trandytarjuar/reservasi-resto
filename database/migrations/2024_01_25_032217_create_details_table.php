<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_meja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_meja')->constrained('mejas')->onDelete('cascade');
            $table->foreignId('id_kapasitas')->constrained('kapasitas')->onDelete('cascade');
            $table->enum('status', ['avail', 'reserve'])->default('avail');
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
        Schema::dropIfExists('detail_meja');
    }
}
