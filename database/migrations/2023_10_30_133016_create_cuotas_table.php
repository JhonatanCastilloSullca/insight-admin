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
        Schema::create('cuotas', function (Blueprint $table) {
            $table->id();
            $table->integer('nroCuota');
            $table->date('fecha')->nullable();
            $table->decimal('monto', 10, 2);
            $table->string('pagado',1)->default(0); //1. Pagado  - 0. Sin Pagar
            $table->BigInteger('moneda_id')-> unsigned()->nullable();
            $table->foreign('moneda_id')->references('id')->on('monedas');
            $table->morphs('pagable');
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
        Schema::dropIfExists('cuotas');
    }
};
