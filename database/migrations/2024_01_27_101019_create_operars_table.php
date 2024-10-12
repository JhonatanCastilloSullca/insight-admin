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
        Schema::create('operars', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->integer('cantidad_pax')->nullable();
            $table->text('observacion')->nullable();
            $table->decimal('precioSoles',10,2)->nullable(); // Renombrado de 'precio' a 'precioSoles'
            $table->bigInteger('servicio_id')->unsigned();
            $table->foreign('servicio_id')->references('id')->on('servicios');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('estado',1)->default('1');
            $table->string('operado',1)->default('0'); //0 = Local // 1 = Endose
            $table->boolean('endose')->default(false);
            $table->boolean('machupicchu')->default(false);
            $table->boolean('otros')->default(false);
            $table->decimal('ingresos',10,2)->nullable();
            $table->boolean('traslado')->default(false);
            $table->bigInteger('ubicacion_id')->unsigned()->nullable();
            $table->foreign('ubicacion_id')->references('id')->on('ubicacions');
            $table->boolean('hotel')->default(false);
            $table->boolean('vuelo')->default(false);
            $table->bigInteger('reserva_id')->unsigned()->nullable();
            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->integer('noches')->default(0);
            $table->boolean('pagado')->default(false);
            $table->decimal('precioDolares',10,2)->nullable();
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
        Schema::dropIfExists('operars');
    }
};
