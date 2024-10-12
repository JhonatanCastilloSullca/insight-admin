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
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 150)->nullable();
            $table->integer('cantidad')->nullable();
            $table->bigInteger('operar_id')->unsigned();
            $table->foreign('operar_id')->references('id')->on('operars');
            $table->bigInteger('moneda_id')->unsigned()->nullable();
            $table->foreign('moneda_id')->references('id')->on('monedas');
            $table->decimal('costo', 10, 2)->nullable();
            $table->bigInteger('proveedor_id')->unsigned()->nullable();
            $table->foreign('proveedor_id')->references('id')->on('proveedors');
            $table->bigInteger('operar_servicio_id')->unsigned()->nullable();
            $table->foreign('operar_servicio_id')->references('id')->on('operar_servicios');
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
        Schema::dropIfExists('incidencias');
    }
};
