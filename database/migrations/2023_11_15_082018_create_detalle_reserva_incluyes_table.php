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
        Schema::create('detalle_reserva_incluyes', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('itinerario_reserva_id')-> unsigned();
            $table->foreign('itinerario_reserva_id')->references('id')->on('itinerario_reservas');
            $table->BigInteger('servicio_incluido_id')-> unsigned();
            $table->foreign('servicio_incluido_id')->references('id')->on('servicios');
            $table->boolean('operar')->default(0);
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
        Schema::dropIfExists('detalle_reserva_incluyes');
    }
};
