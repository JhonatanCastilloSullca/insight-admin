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
        Schema::create('liquidacions', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->integer('tipo');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('proveedor_id')->unsigned();
            $table->foreign('proveedor_id')->references('id')->on('proveedors');
            $table->decimal('acuenta', 11, 2);
            $table->decimal('saldo', 11, 2);
            $table->decimal('total', 11, 2);
            $table->decimal('totalDolares', 11, 2);
            $table->decimal('totalIngresos', 11, 2);
            $table->boolean('pagado')->default(0);
            $table->string('observacion', 150)->nullable();
            $table->string('estado', 1)->default(1);
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
        Schema::dropIfExists('liquidacions');
    }
};
