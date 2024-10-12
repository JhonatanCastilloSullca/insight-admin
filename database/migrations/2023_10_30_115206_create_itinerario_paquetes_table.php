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
        Schema::create('itinerario_paquetes', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('detalle_paquete_id')-> unsigned()->nullable();
            $table->foreign('detalle_paquete_id')->references('id')->on('detalle_paquetes');
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
        Schema::dropIfExists('itinerario_paquetes');
    }
};
