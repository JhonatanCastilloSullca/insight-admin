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
        Schema::create('detalle_liquidacions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('liquidacion_id')->unsigned();
            $table->foreign('liquidacion_id')->references('id')->on('liquidacions');
            $table->morphs('ejecutable');
            $table->integer('cantidad');
            $table->decimal('precio', 15, 2);
            $table->decimal('ingreso', 11, 2);
            $table->decimal('ingresoAnterior', 11, 2);
            $table->bigInteger('servicio_id')->unsigned()->nullable();
            $table->foreign('servicio_id')->references('id')->on('servicios');
            $table->boolean('operar')->default(0);
            $table->bigInteger('moneda_id')->unsigned()->nullable();
            $table->foreign('moneda_id')->references('id')->on('monedas');
            $table->decimal('precioAnterior', 11, 2);
            $table->bigInteger('moneda_id_anterior')->unsigned()->nullable();
            $table->foreign('moneda_id_anterior')->references('id')->on('monedas');
            $table->string('comentarios', 200)->nullable();
            $table->string('estado', 1)->default(1);
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
        Schema::dropIfExists('detalle_liquidacions');
    }
};
