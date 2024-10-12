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
        Schema::create('detalle_reservas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reserva_id')->unsigned();
            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->bigInteger('servicio_id')->unsigned();
            $table->foreign('servicio_id')->references('id')->on('servicios');
            $table->bigInteger('moneda_id')->unsigned();
            $table->foreign('moneda_id')->references('id')->on('monedas');
            $table->datetime('fecha_viaje')->nullable();
            $table->datetime('fecha_viajefin')->nullable();
            $table->integer('pax')->nullable();
            $table->decimal('precio',15,2);
            $table->string('descripcion',150)->nullable();
            $table->integer('equipaje')->default(0);
            $table->text('comentarios')->nullable();
            $table->string('pago',1)->default('0');
            $table->string('tipo',1)->default('1'); //0 = Compartido 1 = Privado   // 0 = Ida 1 = Vuelta
            $table->string('adulto',1)->default('1'); //0 = Niño 1 = Adulto
            $table->string('confirmado',1)->default('0'); //0 = Registrado, 1 = Enviado, 2 = Confirmado
            $table->string('estado',1)->default('1'); // 1. Registrado 2. Operado 3. Devolucion
            $table->string('operado',1)->default('0'); //0 = Registrado, 1 = Operado, 2 = Endosado
            $table->boolean('hotelJisa')->default(false);
            $table->boolean('overview')->default(false);
            $table->integer('orden')->default(0);
            $table->bigInteger('proveedor_id')->unsigned()->nullable();
            $table->foreign('proveedor_id')->references('id')->on('proveedors');
            $table->boolean('reprogramado')->default(false);
            $table->decimal('adicional',15,2)->default(0);
            $table->bigInteger('precio_id')->unsigned()->nullable();
            $table->foreign('precio_id')->references('id')->on('precios');    
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
        Schema::dropIfExists('detalle_reservas');
    }
};
