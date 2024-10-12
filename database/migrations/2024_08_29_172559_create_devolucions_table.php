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
        Schema::create('devolucions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('moneda_id')->unsigned();
            $table->foreign('moneda_id')->references('id')->on('monedas');
            $table->bigInteger('medio_id')->unsigned();
            $table->foreign('medio_id')->references('id')->on('medios');
            $table->bigInteger('reserva_id')->unsigned();
            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->dateTime('fecha');
            $table->decimal('monto', 15, 2);
            $table->string('num_operacion')->nullable();
            $table->string('factura', 1)->default(0);
            $table->text('comentarios')->nullable();
            $table->string('estado', 1)->default(1);
            $table->bigInteger('liquidacion_id')->unsigned()->nullable();
            $table->foreign('liquidacion_id')->references('id')->on('liquidacions');
            $table->bigInteger('operar_servicio_id')->unsigned()->nullable();
            $table->foreign('operar_servicio_id')->references('id')->on('operar_servicios');
            $table->string('imagen', 255)->nullable();
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
        Schema::dropIfExists('devolucions');
    }
};
