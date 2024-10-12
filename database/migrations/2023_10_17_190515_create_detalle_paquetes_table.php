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
        Schema::create('detalle_paquetes', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('paquete_id')-> unsigned();
            $table->foreign('paquete_id')->references('id')->on('paquetes');
            $table->BigInteger('servicio_id')-> unsigned();
            $table->foreign('servicio_id')->references('id')->on('servicios');
            $table->datetime('fecha_viaje')->nullable();
            $table->datetime('fecha_viajefin')->nullable();
            $table->integer('dia_servicio')->nullable();
            $table->integer('paxservicionacional')->nullable();
            $table->integer('paxservicioextranjero')->nullable();
            $table->BigInteger('moneda_id')-> unsigned()->nullable();
            $table->foreign('moneda_id')->references('id')->on('monedas');
            $table->decimal('preciosoles',7,2)->nullable();
            $table->decimal('preciodolares',7,2)->nullable();
            $table->string('tipo',1)->default(1);
            $table->string('adulto',1)->default(0);
            $table->text('descripcion')->nullable();
            $table->text('equipaje')->nullable();
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
        Schema::dropIfExists('detalle_paquetes');
    }
};
