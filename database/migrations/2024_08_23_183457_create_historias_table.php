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
        Schema::create('historias', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('reserva_id')-> unsigned()->nullable();
            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->BigInteger('user_id')-> unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->datetime('fecha');
            $table->json('cambios'); // Para almacenar los cambios en formato JSON
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
        Schema::dropIfExists('historias');
    }
};
