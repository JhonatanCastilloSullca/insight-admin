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
        Schema::create('operar_pasajeros', function (Blueprint $table) {
            $table->id();
            $table->foreign('operar_id')->references('id')->on('operars');
            $table->BigInteger('operar_id')->nullable()->unsigned();
            $table->BigInteger('pasajero_id')-> unsigned();
            $table->foreign('pasajero_id')->references('id')->on('pasajeros');
            $table->foreign('operar_servicio_id')->references('id')->on('operar_servicios');
            $table->BigInteger('operar_servicio_id')->nullable()->unsigned();
            $table->time('recojo')->nullable();                                   
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
        Schema::dropIfExists('operar_pasajeros');
    }
};
