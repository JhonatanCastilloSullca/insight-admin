<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paquete_pasajero', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('pasajero_id')-> unsigned();
            $table->foreign('pasajero_id')->references('id')->on('pasajeros');
            $table->BigInteger('paquete_id')-> unsigned();
            $table->foreign('paquete_id')->references('id')->on('paquetes');
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
        Schema::dropIfExists('pasajero_paquete');
    }
};
