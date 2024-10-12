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
        Schema::create('pasajeros', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 350);
            $table->string('genero', 10);
            $table->date('nacimiento')->nullable();
            $table->string('celular', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('tarifa', 10)->nullable();
            $table->bigInteger('pais_id')->unsigned();
            $table->foreign('pais_id')->references('id')->on('pais');
            $table->bigInteger('documento_id')->unsigned()->nullable();
            $table->foreign('documento_id')->references('id')->on('documentos');
            $table->text('imagen')->nullable();
            $table->text('comentario')->nullable();
            $table->boolean('principal')->default(0);
            $table->string('apellidoPaterno', 350)->nullable();
            $table->string('apellidoMaterno', 350)->nullable();
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
        Schema::dropIfExists('pasajeros');
    }
};
