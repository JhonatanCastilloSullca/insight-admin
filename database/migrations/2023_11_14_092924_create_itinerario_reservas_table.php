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
        Schema::create('itinerario_reservas', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('detalle_reserva_id')-> unsigned()->nullable();
            $table->foreign('detalle_reserva_id')->references('id')->on('detalle_reservas');
            $table->integer('dia');
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
        Schema::dropIfExists('itinerario_reservas');
    }
};
