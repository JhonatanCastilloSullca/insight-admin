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
        Schema::create('cupons', function (Blueprint $table) {
            $table->id();
            $table->string('cupon',150);
            $table->integer('cantidad')->default(0);
            $table->integer('descuento')->default(0);
            $table->integer('maximo')->nullable();
            $table->date('fechaInicio')->nullable();
            $table->date('fechaFin')->nullable();
            $table->decimal('montoSoles',15,2)->default(0);
            $table->decimal('montoDolares',15,2)->default(0);
            $table->string('tipo',1)->default(1);//1. Monto total - 0. Porcentaje
            $table->string('finalizado',1)->default(1);//1. Fecha - 0. Cantidad
            $table->BigInteger('user_id')-> unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('estado',1)->default(1);//1. Activo - 0. Finalizado
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
        Schema::dropIfExists('cupons');
    }
};
