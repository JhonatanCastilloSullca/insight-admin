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
        Schema::create('notificacions', function (Blueprint $table) {
            $table->id();
            $table->text('notificacion')->nullable();
            $table->BigInteger('user_id')-> unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('estado',1)->default(0); //0 = No leido // 1 = Leido // 2 = Anulado
            $table->string('tipo',1)->default(0); //0 = Tour // 1 = Hotel // 2 = Vuelo // 3 = Cumpleaños // 4 Checkin // 5 Correo Enviado
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
        Schema::dropIfExists('notificacions');
    }
};
