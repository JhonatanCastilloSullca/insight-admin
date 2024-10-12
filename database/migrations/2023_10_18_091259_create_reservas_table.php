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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')-> unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->dateTime('fecha');
            $table->string('observacion',250)->nullable();
            $table->BigInteger('paquete_id')-> unsigned()->nullable();
            $table->foreign('paquete_id')->references('id')->on('paquetes');
            $table->text('descripcion',250)->nullable();
            $table->integer('numero')->nullable();
            $table->string('confirmado',1)->default(0); //0. Sin Confirmar // 1. Confirmado
            $table->boolean('cotizacion',1)->default(0);
            $table->boolean('correo',1)->default(0);
            $table->boolean('pagado',1)->default(0);
            $table->boolean('contabilidad',1)->default(0);
            $table->string('estado',1)->default(0); // 1. Registrado 2. Cancelado 3. Reprogramado 4. Con Devolución 5. Finalizado
            
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
        Schema::dropIfExists('reservas');
    }
};
