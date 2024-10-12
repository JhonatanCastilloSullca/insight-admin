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
        Schema::create('paquetes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 250)->nullable();
            $table->text('mensaje_bienvenida')->nullable();
            $table->date('fecha_disponibilidad')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_viaje')->nullable();
            $table->date('fecha_registro')->nullable();
            $table->text('video')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('img_principal')->nullable();
            $table->text('img_secundario')->nullable();
            $table->string('publico', 1)->default(1);
            $table->string('tipo', 1)->default(1);
            $table->string('pagoweb', 1)->default(1);
            $table->integer('cantidad_pax')->nullable();
            $table->integer('cantpaxniños')->nullable();
            $table->decimal('regularsoles', 7, 2)->nullable();
            $table->decimal('regulardolares', 7, 2)->nullable();
            $table->decimal('precio_soles', 7, 2)->nullable();
            $table->decimal('precio_dolares', 7, 2)->nullable();
            $table->decimal('precio_soles_niño', 7, 2)->nullable();
            $table->decimal('precio_dolares_niño', 7, 2)->nullable();
            $table->string('estado', 1)->default(1);
            $table->BigInteger('moneda_id')->unsigned()->nullable();
            $table->foreign('moneda_id')->references('id')->on('monedas');
            $table->BigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->BigInteger('pasajero_id')->unsigned()->nullable();
            $table->foreign('pasajero_id')->references('id')->on('pasajeros');
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
        Schema::dropIfExists('paquetes');
    }
};
