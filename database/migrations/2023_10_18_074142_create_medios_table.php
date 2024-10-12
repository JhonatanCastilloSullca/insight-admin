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
        Schema::create('medios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',150);
            $table->string('banco',100)->nullable();
            $table->string('numero',100)->nullable();
            $table->string('cci',100)->nullable();
            $table->integer('porcentaje')->default(0);
            $table->string('descripcion',250)->nullable();
            $table->BigInteger('moneda_id')-> unsigned();
            $table->foreign('moneda_id')->references('id')->on('monedas');
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
        Schema::dropIfExists('medios');
    }
};
