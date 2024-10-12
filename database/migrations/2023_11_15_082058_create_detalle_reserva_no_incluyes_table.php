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
        Schema::create('detalle_reserva_no_incluyes', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('itinerario_reserva_id')-> unsigned();
            $table->foreign('itinerario_reserva_id')->references('id')->on('itinerario_reservas');
            $table->unsignedBigInteger('servicio_no_incluido_id');
            $table->foreign('servicio_no_incluido_id')->references('id')->on('servicios');
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
        Schema::dropIfExists('detalle_reserva_no_incluyes');
    }
};
