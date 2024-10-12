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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('reserva_id')-> unsigned()->nullable();
            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->BigInteger('cliente_id')-> unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->BigInteger('user_id')-> unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->BigInteger('medio_id')-> unsigned();
            $table->foreign('medio_id')->references('id')->on('medios');
            $table->BigInteger('document_id')-> unsigned();
            $table->foreign('document_id')->references('id')->on('documents');
            $table->integer('nume_doc');
            $table->date('fecha');
            $table->decimal('total',15,2);
            $table->string('sunat',1)->default(0);
            $table->string('descripcion',500)->nullable();
            $table->string('code_note',2)->nullable();
            $table->BigInteger('factura_id')->unsigned()->nullable();
            $table->foreign('factura_id')->references('id')->on('ventas');
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
        Schema::dropIfExists('ventas');
    }
};
