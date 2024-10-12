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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',250);
            $table->BigInteger('ubicacion_id')-> unsigned()->nullable();
            $table->foreign('ubicacion_id')->references('id')->on('ubicacions');
            $table->BigInteger('categoria_id')-> unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias'); 
            $table->string('direccion',200)->nullable();           
            $table->time('checkinn')->nullable();           
            $table->time('checkout')->nullable(); 
            $table->string('trabajo',1)->default(1);  
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
        Schema::dropIfExists('hotels');
    }
};
