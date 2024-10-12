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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string('titulo',150)->nullable();
            $table->text('descripcion')->nullable();
            $table->text('img_principal')->nullable();
            $table->text('template')->nullable();
            $table->text('video')->nullable();
            $table->text('recojo')->nullable();
            $table->text('horario')->nullable();
            $table->BigInteger('categoria_id')-> unsigned()->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->BigInteger('user_id')-> unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('condicion')->nullable();
            $table->string('color',10)->nullable();
            $table->decimal('descuento',7,2)->nullable();
            $table->string('operar',1)->default(1);
            $table->boolean('plantillaOperar',1)->default(0);
            $table->BigInteger('servicio_id')->unsigned()->nullable();
            $table->foreign('servicio_id')->references('id')->on('servicios');            
            $table->BigInteger('proveedor_id')-> unsigned()->nullable();
            $table->foreign('proveedor_id')->references('id')->on('proveedors');    
            $table->boolean('incluye',1)->default(1); // 1. Incluye    0. Servicio
            $table->text('plantillaOverview')->nullable();
            $table->integer('duracion')->default(1);     
            $table->BigInteger('ubicacion_id')-> unsigned()->nullable();
            $table->foreign('ubicacion_id')->references('id')->on('ubicacions');      
            $table->string('estado',1)->default(1);
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
        Schema::dropIfExists('servicios');
    }
};
