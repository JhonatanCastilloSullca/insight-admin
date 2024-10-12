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
        Schema::create('guias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50)->nullable();
            $table->string('celular',20)->nullable();
            $table->string('email',150)->nullable();
            $table->text('direccion',200)->nullable();
            $table->text('imagen')->nullable();
            $table->BigInteger('documento_id')-> unsigned()->nullable();
            $table->foreign('documento_id')->references('id')->on('documentos');
            $table->BigInteger('categoria_id')-> unsigned()->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorias');
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
        Schema::dropIfExists('guias');
    }
};
