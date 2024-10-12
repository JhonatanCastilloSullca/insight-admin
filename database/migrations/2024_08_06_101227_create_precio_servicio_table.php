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
        Schema::create('precio_servicio', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('precio_id')-> unsigned();
            $table->foreign('precio_id')->references('id')->on('precios');
            $table->BigInteger('servicio_id')-> unsigned();
            $table->foreign('servicio_id')->references('id')->on('servicios');
            $table->BigInteger('moneda_id')-> unsigned();
            $table->foreign('moneda_id')->references('id')->on('monedas');
            $table->boolean('privado',1)->default(1); //Compartido 0 -- Privado 1
            $table->boolean('nacional',1)->default(1); //Nacional 1 -- Extranjero 0
            $table->integer('pax')->default(1);
            $table->decimal('precio',7,2)->default(0);
            $table->decimal('precio_minimo',7,2)->default(0);
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
        Schema::dropIfExists('precio_servicio');
    }
};
