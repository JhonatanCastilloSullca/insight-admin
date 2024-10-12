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
        //
        Schema::create('operar_servicios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('operar_id')->unsigned();
            $table->foreign('operar_id')->references('id')->on('operars')->nullable();
            $table->bigInteger('servicio_id')->unsigned();
            $table->foreign('servicio_id')->references('id')->on('servicios')->nullable();
            $table->bigInteger('proveedor_id')->unsigned();
            $table->foreign('proveedor_id')->references('id')->on('proveedors')->nullable();
            $table->decimal('precio', 7, 2)->nullable();
            $table->text('observacion')->nullable();
            $table->time('recojo')->nullable();
            $table->string('tipo', 1)->default('1');
            $table->string('estado', 1)->default('0');
            $table->string('codigo', 100)->nullable();
            $table->string('idioma', 200)->nullable();
            $table->string('imagen', 255)->nullable();
            $table->decimal('acuenta', 7, 2)->nullable();
            $table->decimal('saldo', 7, 2)->nullable();
            $table->date('fechaPago')->nullable();
            $table->boolean('pagado')->default(false);
            $table->bigInteger('detalle_reserva_id')->unsigned()->nullable();
            $table->foreign('detalle_reserva_id')->references('id')->on('detalle_reservas');
            $table->integer('cantidad')->nullable();
            $table->integer('noches')->nullable();
            $table->bigInteger('moneda_id')->unsigned()->nullable();
            $table->foreign('moneda_id')->references('id')->on('monedas');
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
        //
    }
};
