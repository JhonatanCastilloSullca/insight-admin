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
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->string('celular', 20)->nullable();
            $table->string('direccion', 250)->nullable();
            $table->text('email')->nullable();
            $table->string('ruc', 20)->nullable();
            $table->string('razon_social', 250)->nullable();
            $table->bigInteger('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->bigInteger('ubicacion_id')->unsigned()->nullable();
            $table->foreign('ubicacion_id')->references('id')->on('ubicacions');
            $table->time('checkinn')->nullable();
            $table->time('checkout')->nullable();
            $table->date('cumpleanos')->nullable();
            $table->boolean('detalle_hotel')->default(false);
            $table->boolean('correo')->default(true); // 1. Correo Notificacion 0. Whatsapp
            $table->text('imagen')->nullable();
            $table->string('estado', 1)->default('1');
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
        Schema::dropIfExists('proveedors');
    }
};
