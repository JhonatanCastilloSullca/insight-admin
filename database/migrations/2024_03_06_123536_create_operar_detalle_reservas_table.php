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
        Schema::create('operar_detalle_reservas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('operar_id')->unsigned();
            $table->foreign('operar_id')->references('id')->on('operars');
            $table->bigInteger('detalle_reserva_id')->unsigned();
            $table->foreign('detalle_reserva_id')->references('id')->on('detalle_reservas');
            $table->time('recojo')->nullable();
            $table->decimal('ingresos', 10, 2)->nullable();
            $table->integer('cantidad')->nullable();
            $table->integer('noches')->nullable();
            $table->text('observacion')->nullable();
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
        Schema::dropIfExists('operar_detalle_reservas');
    }
};
